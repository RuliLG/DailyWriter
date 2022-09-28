<template>
    <Head title="Escribir" />
    <BreezeAuthenticatedLayout>
        <div>
            <div class="max-w-prose mx-auto">
                <div class="flex justify-end space-x-2 pt-6 print:hidden">
                    <Link class="border border-grey rounded text-sm px-3 py-2 hover:bg-grey-light" :href="route('write.date', todayLink)">Hoy</Link>
                    <input type="month" class="border-grey rounded text-sm" :value="month" @change="didUpdateMonth($event)" />
                </div>

                <div class="flex space-x-1 py-2 overflow-auto print:hidden">
                    <DayEntry
                        v-for="day in days_in_month"
                        :key="day"
                        :date="day"
                        :selected="day == currentDay"
                        :writing="monthly_writings[day]"
                    ></DayEntry>
                </div>

                <div class="bg-white py-16 px-12 shadow-letter mt-4 print:shadow-none print:mt-0">
                    <div class="flex items-center justify-between flex-wrap">
                        <h1 class="text-2xl font-bold text-green-dark">{{ formattedDate }}</h1>
                        <PrintButton />
                    </div>
                    <div class="h-px my-6 bg-grey"></div>
                    <div class="prose">
                        <div v-if="write?.word_count == 0">No hay contenido para esta fecha</div>
                        <editor-content :editor="editor"></editor-content>
                    </div>
                </div>
                <div class="flex justify-between space-x-4 bg-grey-light p-2 text-sm text-green-dark mt-2 print:hidden" v-if="numberOfWords > 0">
                    <span v-if="state === 'unsaved'">Cambios sin guardar</span>
                    <span v-if="state === 'saving'">Guardando...</span>
                    <span v-if="state === 'saved'">Guardado</span>
                    <span>{{ numberOfWords }} {{ numberOfWords === 1 ? 'palabra' : 'palabras' }}</span>
                </div>
                <div class="flex items-center justify-between my-4 print:hidden" v-if="write?.word_count > 0">
                    <button type="button" v-if="canGenerateImages" @click="generateImages" class="text-sm text-green-dark">🎨 Generar imágenes</button>
                    <span v-else-if="!didMeetGoal" class="text-sm text-grey-dark cursor-not-allowed">🎨 Escribe {{ $page.props.goal }} palabras para generar imágenes</span>
                    <span v-else class="text-sm text-grey-dark cursor-not-allowed">🎨 Generando imágenes</span>
                    <a :href="write.ipfs_link" target="_blank" class="text-sm text-green-dark">Ver en IPFS</a>
                </div>
                <div v-show="stableDiffusionResult?.output" class="break-before-page" ref="images">
                    <div v-if="stableDiffusionResult?.output" class="grid grid-cols-2 gap-4 pb-12 md:grid-cols-4">
                        <div v-for="(image, index) in stableDiffusionResult.output" :key="index" class="aspect-square relative cursor-pointer" @click="openImage(index)">
                            <img :src="image" class="absolute inset-0 object-cover object-center" />
                        </div>
                        <vue-easy-lightbox
                            :visible="lightboxIsVisible"
                            :imgs="stableDiffusionResult.output"
                            :index="currentImageIndex"
                            @hide="lightboxIsVisible = false"
                        ></vue-easy-lightbox>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import Placeholder from '@tiptap/extension-placeholder'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import DayEntry from '@/Components/DayEntry.vue'
import PrintButton from '@/Components/PrintButton.vue'
import dayjs from 'dayjs'
import { debounce } from 'debounce'
import VueEasyLightbox from 'vue-easy-lightbox'
import Swal from 'sweetalert2'


export default {
    name: 'Write',
    components: {
        Head,
        Link,
        EditorContent,
        DayEntry,
        PrintButton,
        BreezeAuthenticatedLayout,
        VueEasyLightbox,
    },
    props: {
        raw_date: String,
        month: String,
        date: String,
        days_in_month: Array,
        write: Object,
        monthly_writings: Object,
    },
    data () {
        return {
            didUpdate: null,
            editor: null,
            state: this.write ? 'saved' : 'none',
            imageInterval: null,
            lightboxIsVisible: false,
            currentImageIndex: 0,
        }
    },
    mounted () {
        this.didUpdate = debounce(() => {
            this.save();
        }, 1000);
        this.editor = new Editor({
            content: this.write?.content,
            extensions: [
                StarterKit,
                Placeholder.configure({
                    placeholder: 'Puedes empezar por aquí :-)',
                }),
            ],
            onUpdate: () => {
                this.state = 'unsaved';
                this.didUpdate();
            }
        });

        setTimeout(() => this.editor.view.dom.focus(), 50)
    },
    beforeUnmount() {
        this.editor.destroy()
    },
    computed: {
        formattedDate () {
            return dayjs(this.date).format('D [de] MMMM [de] YYYY')
        },
        currentDay () {
            return dayjs(this.date).format('YYYY-MM-DD')
        },
        numberOfWords () {
            return this.write?.word_count || 0
        },
        todayLink () {
            return dayjs().format('YYYYMMDD')
        },
        stableDiffusionResult () {
            return this.write?.stable_diffusion_result
        },
        didMeetGoal () {
            return this.write?.word_count >= this.$page.props.goal
        },
        canGenerateImages () {
            if (!this.didMeetGoal) {
                return false;
            }

            return !this.stableDiffusionResult || this.stableDiffusionResult?.status === 'succeeded' || this.stableDiffusionResult?.status === 'failed'
        },
    },
    methods: {
        save () {
            const contentBefore = this.editor.getHTML()
            const wordsBefore = this.write?.word_count || 0
            this.state = 'saving';
            this.$inertia.post('/write/' + this.raw_date, {
                content: this.editor.getHTML(),
            }, {
                preserveScroll: true,
                onSuccess: () => {
                    const wordsAfter = this.write?.word_count || 0
                    this.state = this.editor.getHTML() === contentBefore ? 'saved' : 'unsaved';
                    if (wordsAfter >= this.$page.props.goal && wordsBefore < this.$page.props.goal) {
                        this.completeDailyGoal()
                    }
                },
            })
        },
        didUpdateMonth($event) {
            this.$inertia.visit('/write/' + $event.target.value.replace('-', '') + '01')
        },
        generateImages() {
            Swal.fire({
                title: 'Generando imágenes con IA...',
                didOpen: () => {
                    Swal.showLoading();
                    fetch('/write/' + this.raw_date + '/stable-diffusion', { method: 'POST' })
                        .then(response => response.json())
                        .then(() => {
                            this.imageInterval = setInterval(() => {
                                this.$inertia.reload({
                                    only: ['write'],
                                    onSuccess: async () => {
                                        const can = this.write?.stable_diffusion_result?.status === 'succeeded' || this.write?.stable_diffusion_result?.status === 'failed'
                                        if (can) {
                                            clearInterval(this.imageInterval);
                                            await Swal.hideLoading();
                                            await Swal.close();
                                            this.$refs.images.scrollIntoView({ behavior: 'smooth' });
                                        }
                                    }
                                });
                            }, 5000);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(),
                backdrop: true,
            });
        },
        openImage(index) {
            this.currentImageIndex = index;
            this.lightboxIsVisible = true;
        },
        completeDailyGoal() {
            window.confetti.addConfetti().then(() => {
                Swal.fire({
                    title: '¡Felicidades!',
                    text: 'Has completado tu meta diaria de ' + this.$page.props.goal + ' palabras. ¿Quieres generar una imagen con IA sobre lo que has escrito hoy?',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: '¡Sí!',
                    cancelButtonText: 'No, gracias',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.generateImages()
                    }
                });
            });
        }
    }
}
</script>
