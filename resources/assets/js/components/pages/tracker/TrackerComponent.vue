<template>
    <div class="container">
        <!-- loader -->
        <loader-component :show-loader="showLoader"></loader-component>
        
        <!-- time tracker -->
        <div class="d-flex justify-content-center pt-5 pb-3">
            <div class="d-flex flex-column justify-content-end pr-5">
                <div class="small">days</div>
                <p class="text-right">{{ days }}</p>
            </div>
            <div class="d-flex flex-column justify-content-between clock-block">
                <div class="small text-center">Hours</div>
                <div class="display-clock">{{ hours | formatClock }}</div>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <div class="display-clock">:</div>
            </div>
            <div class="d-flex flex-column justify-content-end clock-block">
                <div class="small text-center">Minutes</div>
                <div class="display-clock">{{ minutes | formatClock }}</div>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <div class="display-clock">:</div>
            </div>
            <div class="d-flex flex-column justify-content-between clock-block">
                <div class="small text-center">Seconds</div>
                <div class="display-clock">{{ seconds | formatClock }}</div>
            </div>
        </div>

        <!-- control buttons -->
        <div class="text-center">
            <button class="btn btn-lg btn-primary" 
                @click="startTracker"
                v-if="!timer">
                <i class="fas fa-play"></i> 
                <span v-if="!timerIncremented">Start</span>
                <span v-else>Resume</span>
            </button>
            <button class="btn btn-lg btn-warning" 
                v-if="timer"
                @click="stopTracker">
                <i class="fas fa-pause"></i> Stop/Pause
            </button>
            <button class="btn btn-lg btn-danger" 
                v-if="!timer && timerIncremented"
                @click="resetTracker">
                <i class="far fa-circle"></i> Reset
            </button>
            <button class="btn btn-lg btn-success"
                data-toggle="collapse" 
                href="#task-description" 
                aria-expanded="false" v-if="!timer && timerIncremented">
                <i class="fas fa-save"></i> Save Task
             </button>
        </div>

        <!-- task description area -->
        <form class="collapse py-3" id="task-description"
            v-if="!timer && timerIncremented"
            @submit.prevent="saveTask()">
            <textarea class="form-control mb-2" style="resize: none;"
                placeholder="Please write the task description here..."
                v-validate="'required'" v-model="description" name="description"
                rows="3" autofocus>
            </textarea>
            <span class="small text-danger">{{ errors.first('description') }}</span>
            <input type="submit" value="Done" class="btn btn-lg btn-info float-right">
        </form>
    </div>
</template>

<script>
    import loaderComponent from '../../inc/LoaderComponent.vue'

    export default {
        name: 'tracker-component',
        components: {
            'loader-component': loaderComponent
        },
        data() {
            return {
                timer: null,
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,
                description: null,
                showLoader: false
            }
        },
        methods: {
            startTracker() {
                this.timer = setInterval(this.incrementTimer, 1000);
            },
            stopTracker() {
                clearTimeout(this.timer);
                this.timer = null;
            },
            resetTracker() {
                this.days = 0
                this.hours = 0
                this.minutes = 0
                this.seconds = 0
            },
            incrementTimer() {
                if(this.seconds < 59) {
                    this.seconds++
                }
                else {
                    if(this.minutes < 59) {
                        this.minutes++
                        this.seconds = 0
                    }
                    else {
                        if(this.hours < 23) {
                            this.hours++
                            this.seconds = 0
                            this.minutes = 0
                        }
                        else {
                            this.days++
                            this.seconds = 0
                            this.minutes = 0
                            this.hours = 0
                        }
                    }
                }
            },
            saveTask() {
                // validate
                this.$validator.validate().then(result => {
                    if (result) {
                        this.showLoader = true
                        axios.post('/api/task' , {
                            days: this.days,
                            hours: this.hours,
                            minutes: this.minutes,
                            seconds: this.seconds,
                            description: this.description
                        })
                        .then(response => {
                            this.resetTracker()
                            this.showLoader = false
                        })
                        .catch(err => {
                            this.showLoader = false                   
                        })
                    }
                })
            }
        },
        computed: {
            timerIncremented() {
                if(this.seconds != 0 || this.minutes != 0 || this.hours != 0 || this.days != 0) {
                    return true
                }
            }
        }
    }
</script>
