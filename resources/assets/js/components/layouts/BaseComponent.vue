<template>
    <div class="pb-5">
        <div class="text-center p-3 logo-section">
            <img src="images/logo-white.png" height="40px"> <span class="h1">Time Tracker</span>
        </div>
        <div class="h3 text-center p-3 nav-section">
            <router-link to="/" class="btn btn-success btn-lg">TRACKER</router-link>
            <router-link to="/tasks" class="btn btn-success btn-lg">TASKS</router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'base-component'
}
</script>
