<template>
    <div>

        <!--<button type="button" @click="showModal = true" style="position: absolute; top: 40vh; left: 50vw; z-index: 5555;">SHOW</button>-->
        <button type="button" class="yootyButt" @click="showModal = !showModal">Choisir ce helper</button>

        <div class="popup-background" v-show="showModal">
            <div class="container-popup">
                <div class="container-note text-center">
                    <div class="text-center">Confirmer le choix de</div>
                    <div class="spacer10"></div>
                    <h1 class="f-boldSE caps text-center">{{name}}&nbsp;{{surname}}</h1>
                    <div class="spacer10"></div>
                    <p class="f-reg main-txt caps text-center">comme assistant à ce message ?</p>
                    <div class="spacer10"></div>

                    <form v-bind:action="'/assistance/yesassistant/'+message_id" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf" />
                        <input hidden type="number" name="user" v-bind:id="'user_'+id" v-bind:value="id" />
                        <div class="spacer10"></div>
                        <button href="/conversations" class="yootyButtWhite black" style="padding: 8px 20px; width: 160px; margin: 0 auto;">Oui</button>
                    </form>

                    <div class="spacer10"></div>
                    <a href="#" class="caps black underline f-14" @click="showModal = !showModal">Non</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                //csrf token
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                showModal: false,
            }
        },
        props: [
            'id',
            'name',
            'surname',
            'message_id'
        ],
        mounted() {
            this.ReadyToCoach()
        },

        methods: {
            ReadyToCoach: function () {
                console.log('PopUp Confirmation ASSistant mounted')
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

