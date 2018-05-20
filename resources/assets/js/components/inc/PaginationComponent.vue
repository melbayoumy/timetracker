<template>
    <nav v-if="lastpage > 1">
        <ul class="pagination justify-content-center">
            <li v-bind:class="{'disabled': this.currentpage == 1}" class="page-item" @click.prevent="changepage(previousPage)">
                <a class="page-link">Previous</a>
            </li>
            <li v-bind:class="{'active': currentpage == 1}" class="page-item" @click.prevent="changepage(1)">
                <a class="page-link">1</a>
            </li>

            <!-- pages itiration -->
            <li v-if="pages[0] > 2" class="page-item disabled">
                <a class="page-link">...</a>
            </li>
            <li v-bind:class="{'active': currentpage == page}" class="page-item" 
            @click.prevent="changepage(page)" v-bind:key="index" v-for="(page, index) in pages">
                <a class="page-link">{{ page }}</a>
            </li>
            <li v-if="pages[pages.length-1] < lastpage - 1" class="page-item disabled">
                <a class="page-link">...</a>
            </li>

            <li v-bind:class="{'active': currentpage == lastpage}" class="page-item" @click.prevent="changepage(lastpage)">
                <a class="page-link">{{ lastpage }}</a>
            </li>
            <li v-bind:class="{'disabled': currentpage == lastpage}" class="page-item" @click.prevent="changepage(nextPage)">
                <a class="page-link">Next</a>
            </li>
        </ul>
    </nav>  
</template>

<script>
export default {
    name: 'pagination',
    props: {
        lastpage: {
            type: Number,
            default: '',
            required: true
        },
        currentpage: {
            type: Number,
            default: '',
            required: true
        },
        limit: {
            type: Number,
            default: 1,
            required: true
        }
    },
    methods: {
        changepage(page) {
            if(page != this.currentpage)
                this.$emit('changepage', page)
        }
    },
    computed: {
        nextPage() {
            if(this.currentpage < this.lastpage)
                return this.currentpage + 1
            else 
                return this.lastpage
        },
        previousPage() {
            if(this.currentpage <= 1)
                return 1
            else
                return this.currentpage - 1
        },
        pages() {
            let viewable = (2 * this.limit) + 1
            let start = ''
            let end = ''

            if(this.currentpage < viewable) {
                start = 2;
                if(this.currentpage >= this.lastpage - viewable) {
                    end = this.lastpage - 1
                }else{
                    end = viewable + 1
                }
            }else{
                if(this.currentpage > this.lastpage - viewable) {
                    end = this.lastpage - 1
                }else{
                    end = this.currentpage + 1
                }
                start = end - viewable + 1 <= 1 ? 2 : end - viewable + 1
            }


            if(start <= end) {
                let array = []
                for(let i = start; i <= end; i++)
                    array.push(i)
                return array
            }
            else
                return new Array(0)
        }
    }

}
</script>