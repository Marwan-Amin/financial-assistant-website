<template>
 <div class="row">
 
 </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            Echo.join(`comments`)
            .here((users)=>{
                console.log(users);
            }).joining((user)=>{
                console.log(`${user.name} joined`)
            }).leaving((user)=>{
                console.log(`${user.name} left`)
            })
        }
    }
</script>
