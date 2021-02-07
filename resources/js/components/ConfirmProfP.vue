<template>
    <div>

        <button type="button" class="yootyBTN_public_profile f-btn_public_profile" @click="showModal = !showModal">Professeur particulier</button>

        <div class="popup-background" v-show="showModal">
            <div class="container-popup">
                <div class="container-note text-center">
                    <div class="text-center">Confirmer le choix de</div>
                    <div class="spacer10"></div>
                    <h1 class="f-boldSE caps text-center">{{name}}&nbsp;{{surname}}</h1>
                    <div class="spacer10"></div>
                    <p class="f-reg main-txt caps text-center">en tant que professeur particulier ?</p>
                    <div class="spacer10"></div>

                    <form action="/coach/apply" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf" />
                        <input hidden type="number" name="user[]" v-bind:id="'user_'+id" v-bind:value="id" />

                        <div class="row justify-content-center">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col">
                                        <input type="radio" id="week" name="duration" value="week">
                                        <label for="week">Week</label>
                                    </div>
                                    <div class="col">
                                        <input type="radio" id="month" name="duration" value="month" checked>
                                        <label for="month">Month</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3"></div>
                        </div>

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
            'surname'
        ],
        mounted() {
            //this.ReadyToCoach()
        },

        methods: {
            ReadyToCoach: function () {
                //console.log('PopUp Confirmation mounted')
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

