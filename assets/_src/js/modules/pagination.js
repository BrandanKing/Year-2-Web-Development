export const pagination = Vue.component('pagination', {
    template: ` <div class="max-w-8xl mx-auto container py-3" v-if="totalPages > 1">
                    <ul class="flex justify-center items-center">
                        <li @click="updatePage(prev)" v-if="showPrevLink">
                            <span class="cursor-pointer flex rounded transition duration-150 ease-in-out text-brand dark:text-white text-base leading-tight font-bold  p-1 focus:outline-none">
                                <svg width="20" height="20">
                                    <use xlink:href="#arrow-left"></use>
                                </svg>
                            </span>
                        </li>
                        <li v-if="firstPage" @click="updatePage(0)">
                            <span :class="current_page == 0 ? 'bg-tomato-500 text-white' :  'text-brand dark:text-white'" class="flex text-base leading-tight font-bold cursor-pointer transition duration-150 ease-in-out mx-2 focus:outline-none h-6 w-6 item-center justify-center rounded">1</span>
                        </li>
                        <li v-for="page in pages" @click="updatePage(page)">
                            <span :class="current_page == page ? 'bg-tomato-500 text-white' :  'text-brand dark:text-white'" class="flex text-base leading-tight font-bold cursor-pointer transition duration-150 ease-in-out mx-2 focus:outline-none h-6 w-6 item-center justify-center rounded">{{page + 1}}</span>
                        </li>
                        <li v-if="lastPage">
                            <span class="cursor-pointer flex rounded transition duration-150 ease-in-out text-brand dark:text-white text-base leading-tight font-bold  p-1 focus:outline-none">...</span>
                        </li>
                        <li v-if="lastPage" @click="updatePage(totalPages - 1)">
                            <span class="flex text-brand dark:text-white text-base leading-tight font-bold cursor-pointer transition duration-150 ease-in-out mx-2 focus:outline-none h-6 w-6 item-center justify-center rounded">{{totalPages}}</span>
                        </li>
                        <li@click="updatePage(next)" v-if="showNextLink">
                            <span class="cursor-pointer flex rounded transition duration-150 ease-in-out text-brand dark:text-white text-base leading-tight font-bold p-1 focus:outline-none">
                                <svg width="20" height="20">
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </span>
                        </li@click=>
                    </ul>
                </div>`,
    props: ['current_page', 'row_count_page', 'total_users', 'page_range'],
    computed: {
        prev() {
            return this.current_page - 1
        },
        next() {
            return this.current_page + 1
        },
        rangeStart() {
            var start = this.current_page - this.page_range
            return (start > 0) ? start : 0;
        },
        rangeEnd() {
            var end = this.current_page + this.page_range
            return (end < this.totalPages) ? end : this.totalPages
        },
        pages() {
            var pages = []
            for (var i = this.rangeStart; i < this.rangeEnd; i++) {
                pages.push(i)
            }
            return pages
        },
        totalPages() {
            return Math.ceil(this.total_users / this.row_count_page);
        },
        firstPage() {
            return this.rangeStart !== 0
        },
        lastPage() {
            return this.rangeEnd < this.totalPages
        },
        showPrevLink() {
            return this.current_page == 0 ? false : true;
        },
        showNextLink() {
            return this.current_page == (this.totalPages - 1) ? false : true;
        }
    },
    methods: {
        updatePage(pageNumber) {
            this.$emit('page-update', pageNumber);
        },
    }
});
