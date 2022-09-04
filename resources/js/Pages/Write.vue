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
                <div class="text-right mt-4 print:hidden">
                    <a v-if="write?.word_count > 0" :href="write.ipfs_link" target="_blank" class="text-sm text-green-dark">Ver en IPFS</a>
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

export default {
    name: 'Write',
    components: {
        Head,
        Link,
        EditorContent,
        DayEntry,
        PrintButton,
        BreezeAuthenticatedLayout,
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
        })
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
    },
    methods: {
        save () {
            const contentBefore = this.editor.getHTML()
            this.state = 'saving';
            this.$inertia.post('/write/' + this.raw_date, {
                content: this.editor.getHTML(),
            }, {
                onSuccess: () => {
                    this.state = this.editor.getHTML() === contentBefore ? 'saved' : 'unsaved';
                },
            })
        },
        didUpdateMonth($event) {
            this.$inertia.visit('/write/' + $event.target.value.replace('-', '') + '01')
        }
    }
}
</script>
