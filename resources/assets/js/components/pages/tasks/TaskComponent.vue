<template>
    <tr>
        <td class="text-nowrap" v-if="!showEditForm">
            <a href="" title="Delete" 
                @click.prevent="$emit('deleteTask')">
                <i class="fas fa-ban text-danger"></i>
            </a>
            <a href="" title="Edit"
                @click.prevent="showEditForm = !showEditForm">
                <i class="fas fa-edit text-warning"></i>
            </a>
        </td>
        <td v-else>
            <button
                class="btn btn-sm btn-info w-100 mb-1"
                @click="updateTask()">
                Save changes
            </button>
            <button 
                class="btn btn-sm btn-secondary w-100"
                @click="showEditForm = !showEditForm">
                Cancel
            </button>
        </td>
        <th scope="row" class="text-nowrap">{{ task.created_at }}</th>
        <td class="text-right pr-3">
            <span v-if="!showEditForm">
                {{ task.days }} &nbsp; &nbsp; {{ task.hours | formatClock }} 
                : {{ task.minutes | formatClock }} : {{ task.seconds | formatClock }}
            </span>
            <span v-else class="form-row">
                <div class="form-group col-md col-12">
                    <input type="text" class="form-control form-control-sm" 
                    name="days" v-model="task.days"
                    v-validate="'required|numeric|min_value:0'" placeholder="days">
                    <span class="small text-danger">{{ errors.first('days') }}</span>
                </div>
                <div class="form-group col-md col-12">
                    <input type="text" class="form-control form-control-sm" 
                    name="hours" v-model="task.hours"
                    v-validate="'required|numeric|min_value:0|max_value:23'" placeholder="hh">
                    <span class="small text-danger">{{ errors.first('hours') }}</span>
                </div>
                :
                <div class="form-group col-md col-12">
                    <input type="text" class="form-control form-control-sm" 
                        name="minutes" v-model="task.minutes" 
                        v-validate="'required|numeric|min_value:0|max_value:59'" placeholder="mm">
                    <span class="small text-danger">{{ errors.first('minutes') }}</span>
                </div>
                :
                <div class="form-group col-md col-12">
                    <input type="text" class="form-control form-control-sm" 
                        name="seconds" v-model="task.seconds" 
                        v-validate="'required|numeric|min_value:0|max_value:59'" placeholder="ss">
                    <span class="small text-danger">{{ errors.first('seconds') }}</span>
                </div>
            </span>
        </td>
        <td>
            <span v-if="!showEditForm">{{ task.description }}</span>
            <span v-else>
                <textarea class="form-control form-control-sm" style="resize: none;"
                    name="description" v-model="task.description" 
                    v-validate="'required'" placeholder="Please enter task description here...">
                </textarea>
                <span class="small text-danger">{{ errors.first('description') }}</span>
            </span>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'task-component',
    props: [
        'task'
    ],
    data() {
        return {
            showEditForm: false
        }
    },
    methods: {
        updateTask() {
            // validate 
            this.$validator.validate().then(result => {
                if (result) {
                    this.$emit('showLoader', true)
                    axios.put(`/api/task/${this.task.id}`, this.task)
                    .then(response => {
                        this.$emit('showLoader', false)
                        this.showEditForm = false
                    })
                    .catch(err => {
                        this.$emit('showLoader', false)
                    })
                }
            })
        }
    }
}
</script>

