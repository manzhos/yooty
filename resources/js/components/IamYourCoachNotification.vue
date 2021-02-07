<template>
    <div class="container h-0">

        <transition name="fade" appear>
            <div class="modal-overlay" v-if="showModal" @click="showModal = false"></div>
        </transition>

        <div v-if="showModal" class="container-popup">
            <div class="container-note text-center">
                <div class="text-center">Vous avez demande en attente</div>
                <div class="spacer20"></div>
                <h1 class="f-boldSE caps text-center">{{user.name}}&nbsp;{{user.surname[0]}}</h1>
                <div class="spacer10"></div>
                <p class="f-reg main-txt caps text-center">prêt à être à vous Professeur particulier</p>
<!--
                <a :href="'/profile/publicprofile?id=' + user.id" class="caps black underline f-14">Voir le profil</a>
-->
                <div class="spacer20"></div>
                <a href="/conversations" class="yootyButtWhite black" style="padding: 8px 20px; width: 160px; margin: 0 auto;">Conversations</a>
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
                showModal: false,
                /*id: 0*/
            }
        },
        props: [
            'id'
        ],
        mounted() {
            this.ReadyToCoach()
        },

        methods: {
            ReadyToCoach: function () {
                console.log('PopUpNotifications ReadyToCoach for user ' + this.id + ' is mounted')

                this.showModal = false

                Echo.private('ReadyToCoach')
                    .listen('IamYourCoach', (notification) => {
                        this.user = JSON.parse(notification.message)
                        if(this.id == this.user.student) {
                            this.showModal = true
                        }
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

