<template>
    <div class="container">
        <!-- loader -->
        <loader-component :show-loader="showLoader"></loader-component>

<!-- if no task found -->
        <!-- create new task -->
        <button class="btn btn-lg btn-secondary"
            data-toggle="collapse" 
            href="#create-task" 
            aria-expanded="false">
            <i class="fas fa-plus-square"></i> add new task
        </button>

        <form class="py-3 clearfix collapse" id="create-task" @submit.prevent="createTask()">
            <div class="form-row justify-content-center">
                <div class="form-group col-md-1 col-2">
                    <input type="number" class="form-control form-control-sm" 
                    name="days" v-model="days" min="0" 
                    v-validate="'required|numeric|min_value:0'" placeholder="days">
                    <span class="small text-danger">{{ errors.first('days') }}</span>
                </div>
                <div class="form-group col-md-1 col-2">
                    <input type="number" class="form-control form-control-sm" 
                    name="hours" v-model="hours" min="0" max="23" 
                    v-validate="'required|numeric|min_value:0|max_value:23'" placeholder="hh">
                    <span class="small text-danger">{{ errors.first('hours') }}</span>
                </div>
                :
                <div class="form-group col-md-1 col-2">
                    <input type="number" class="form-control form-control-sm" 
                        name="minutes" v-model="minutes" min="0" max="59" 
                        v-validate="'required|numeric|min_value:0|max_value:59'" placeholder="mm">
                    <span class="small text-danger">{{ errors.first('minutes') }}</span>
                </div>
                :
                <div class="form-group col-md-1 col-2">
                    <input type="number" class="form-control form-control-sm" 
                        name="seconds" v-model="seconds" min="0" max="59" 
                        v-validate="'required|numeric|min_value:0|max_value:59'" placeholder="ss">
                    <span class="small text-danger">{{ errors.first('seconds') }}</span>
                </div>
            </div>
            <textarea class="form-control form-control-sm mb-2" style="resize: none;"
                name="description" v-model="description" 
                v-validate="'required'" placeholder="Please enter task description here...">
            </textarea>
            <span class="small text-danger">{{ errors.first('description') }}</span>
            <button type="submit" class="btn btn-info float-right">Save</button>
        </form>

        <div class="row py-2">
            <!-- search -->
            <div class="col-md-6 offset-md-3">
                <input type="text" 
                    class="form-control" 
                    style="border-radius: 100px; padding-right: 40px;"
                    placeholder="Search in description..."
                    v-model="searchWord"
                    @keyup.enter="changePage(1)">
                <i class="fas fa-search position-absolute fa-lg"
                    style="right: 28px;
                        top: 10px;
                        cursor: pointer;"
                    @click="changePage(1)">
                </i>
            </div>

            <!-- sort by -->
            <div class="col-md-3 text-right">
                sort by 
                <select @change="sortTasks($event.target.value)">
                    <option value="finished_at_desc">finished at (desc)</option>
                    <option value="finished_at_asc">finished at (asc)</option>
                    <option value="longest_duration">longest duration</option>
                    <option value="shortest_duration">shortest duration</option>
                </select>
            </div>
        </div>

        <!-- tasks view -->
        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th scope="col">Edit</th>
                    <th scope="col">Finished at</th>
                    <th scope="col" class="text-nowrap text-right pr-3">Duration (days hh:mm:ss)</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr
                is="task-component"
                :key="task.id"
                v-for="(task, index) in tasks.data"
                :task="task"
                @deleteTask="deleteTask(index, task.id)"
                @showLoader="showLoader = $event"
                ></tr>
            </tbody>
        </table>

        <!-- pagination -->
        <pagination-component
            :lastpage="parseFloat(tasks.last_page)"
            :currentpage="parseFloat(tasks.current_page)"
            :limit=2
            @changepage="changePage($event)"
        ></pagination-component>
    </div>
</template>

<script>
import loaderComponent from '../../inc/LoaderComponent.vue'
import taskComponent from './TaskComponent.vue'
import paginationComponent from '../../inc/PaginationComponent.vue'

export default {
    name: 'tasks-component',
    components: {
        'loader-component': loaderComponent,
        'task-component': taskComponent,
        'pagination-component': paginationComponent
    },
    created() {
        // get tasks
        this.getTasks()
    },
    data() {
        return {
            tasks: {
                data: []
            },
            days: null,
            hours: null,
            minutes: null,
            seconds: null,
            description: null,
            showLoader: false,
            sortBy: 'created_at_desc',
            searchWord: null
        }
    },
    methods: {
        createTask() {
            // validate
            this.$validator.validate().then(result => {
                if (result) {
                    this.showLoader = true
                    axios.post('/api/task', {
                        days: this.days,
                        hours: this.hours,
                        minutes: this.minutes,
                        seconds: this.seconds,
                        description: this.description
                    })
                    .then(response => {
                        this.showLoader = false
                        this.getTasks()
                    })
                    .catch(err => {
                        this.showLoader = false               
                    })
                }
            });
        },
        getTasks() {
            let page = this.$route.params.page || 1

            this.showLoader = true
            axios.get('/api/task', {
                params: {
                    'page': page,
                    'sort_by': this.sortBy,
                    'description': this.searchWord
                }
            })
            .then(response => {
                this.tasks = response.data
                this.showLoader = false
            })
            .catch(err => {
                this.showLoader = false
            })
        },
        deleteTask(index, id) {
            swal({
                title: "Confirmation",
                text: "Please confirm deleting the task!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.showLoader = true
                        axios.delete(`/api/task/${id}`)
                        .then(response => {
                            this.tasks.data.splice(index, 1)
                            this.showLoader = false
                            swal("Task deleted successfully!", {
                                icon: "success",
                            });
                        })
                        .catch(err => {
                            this.showLoader = false
                        })
                } else {
                    swal("Task is not deleted!");
                }
            });
        },
        sortTasks(value) {
            this.sortBy = value
            this.$router.push({name: 'tasks', params: { page: 1 }})
            this.getTasks()
        },
        changePage(value) {
            this.$router.push({name: 'tasks', params: { page: value }})
            this.getTasks()
        }
    }
}
</script>
