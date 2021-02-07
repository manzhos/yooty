<template>
    <div class="container h-0 ">

        <transition name="fade" appear>
            <div class="modal-overlay" v-if="showModal" @click="showModal = false"></div>
        </transition>

        <div v-if="showModal" class="container-popup">
            <div class="container-note text-center">
                <div class="text-center">Vous avez 1 demande en attente</div>
                <div class="text-center">Professeur particulier</div>
                <div class="spacer20"></div>
                <h1 class="f-boldSE caps text-center">{{user.name}}&nbsp;{{user.surname[0]}}</h1>

                <div class="spacer10"></div>
                <a :href="'/profile/publicprofile/' + user.id" class="caps black underline f-14">Voir le profil</a>
                <div class="spacer20"></div>
                <a :href="'/readytocoach?id=' + user.id + '&duration=' + duration + '&userprof_id=' + userprof_id" class="yootyButtWhite black" style="padding: 8px 20px; width: 160px; margin: 0 auto;">Voir la demande</a>
                <div class="spacer35"></div>
                <a href="#" class="caps black underline f-14" @click="showModal = false">répondre plus tard</a>
            </div>
        </div>
        <!--
                <div class="fade-notification"></div>
        -->
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                user: [],
                duration: '',
                userprof_id: '',
                showModal: false,
                /*id: 0*/
            }
        },
        props: [
            'id'
        ],
        mounted() {
            this.beMyCoach()
        },
/*
        events:{
            showModal: function(item){
                this.$broadcast('showModal', item)
            }
        },
*/
        methods: {
            beMyCoach: function () {
                console.log('PopUpNotifications beMyCoach for user ' + this.id + ' is mounted')

                this.showModal = false

                Echo.private('App.Models.User.'+this.id)
                    .notification((notification) => {
                        //console.log(notification.message);
                        this.data = JSON.parse(notification.message);
                        var arr = Object.values(this.data);
                        //console.log('User::: ' + arr[0][0].name);
                        this.user = arr[0][0]
                        //console.log('Duration::: ' + arr[0][1]);
                        this.duration = arr[0][1]
                        //console.log('userprof_id::: ' + arr[0][2]);
                        this.userprof_id = arr[0][2]
                        this.showModal = true;
                    });
            }
        }
    }
</script>

<style>
    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 98;
        background-color: rgba(0, 0, 0, 0.3);
    }
</style>

