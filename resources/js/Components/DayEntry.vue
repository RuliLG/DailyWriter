<template>
    <Link
        ref="link"
        :href="link"
        class="relative border rounded w-10 flex-shrink-0 flex flex-col justify-center items-center py-2 tabular-nums"
        :class="classes.join(' ')"
    >
        <div v-if="writing?.reached_goal" class="absolute left-0 top-0 right-0 mx-auto w-3 h-3 rounded-full bg-success -translate-y-1/2 flex items-center justify-center">
            <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <span class="text-xs uppercase">{{ weekday }}</span>
        <span
            class="text-xs font-bold"
            :class="{
                'underline': selected || isToday,
            }"
        >
            {{ day }}
        </span>
    </Link>
</template>

<script>
import dayjs from 'dayjs';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: 'DayEntry',
    components: {
        Link,
    },
    props: {
        date: {
            required: true,
            type: String
        },
        writing: {
            required: false,
            type: Object,
        },
        selected: Boolean,
    },
    mounted () {
        if (this.selected) {
            this.$refs.link.$el.scrollIntoView({
                behavior: 'auto',
                block: 'center',
                inline: 'center'
            })
        }
    },
    computed: {
        isToday () {
            return dayjs(this.date).isSame(dayjs(), 'day')
        },
        day () {
            return parseInt(dayjs(this.date).format('D'))
        },
        weekday () {
            return dayjs(this.date).format('ddd').substring(0, 1)
        },
        link () {
            return '/write/' + dayjs(this.date).format('YYYYMMDD')
        },
        classes () {
            const classes = []
            if (this.writing?.reached_goal) {
                classes.push('bg-success-light', 'text-white', 'border-success-light')
                return classes
            } else if (this.writing && !this.writing.reached_goal && this.writing.word_count > 0) {
                classes.push('bg-yellow', 'text-primary-dark', 'border-yellow-dark')
                return classes
            }

            if (this.selected) {
                classes.push('border-green-light', 'bg-white', 'text-grey-dark')
            } else {
                classes.push('bg-grey', 'border-grey', 'text-grey-dark')
            }
            return classes
        }
    },
}
</script>
