<template>
    <div class="container">
        <div class="position-relative">

            <form action="/signaler" method="get" role="form" id="compte-form">
                <input type="hidden" name="_token" v-bind:value="csrf">
                <!-- Block dropdown menus -->
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-6 zero">
                        <div class="title-select" @click="optionsVisible = !optionsVisible">
                            <span>{{select}}</span>
                            <div class="select_icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="options-select" v-show="optionsVisible">
                            <div @click="selectOption('Pas de réponse')">
                                <input id="Pas_de_réponse" class="select_input hidden" type="radio" name="reason" value="Pas de réponse" />
                                <label for="Pas_de_réponse" class="select_label d-block select_item option-list">Pas de réponse</label>
                            </div>
                            <div @click="selectOption('Contenu inapproprié')">
                                <input id="Contenu_inapproprié" class="select_input hidden" type="radio" name="reason" value="Contenu inapproprié" />
                                <label for="Contenu_inapproprié" class="select_label d-block select_item option-list">Contenu inapproprié</label>
                            </div>
                            <div @click="selectOption('Autre')">
                                <input id="Autre" class="select_input hidden" type="radio" name="reason" value="Autre" />
                                <label for="Autre" class="signaler-popup-close select_label d-block select_item option-list">Autre</label>
                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="col-md-6 text-right">
                        <button type="submit" class="button-conv-popup d-inline-block" style="border: 0 solid white">Terminer le chat</button>
                        <div class="spacer20_right">&nbsp;</div>
                        <a href="#" class="signaler-popup-close link-conv-popup d-inline-block">Annuler</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "SignalerReason",

        data: function() {
            return {
                //csrf token
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                optionsVisible: false,
                select: 'Reason',
            }
        },

        mounted() {
            //
        },

        methods: {
            selectOption: function (option) {
                this.optionsVisible = false;
                this.select = option;
            },
        }
    }

</script>

<style scoped>

    .option-list{
        margin: 0;
        cursor: pointer;
        text-align: left;
        font-size: 15px;
        line-height: 20px;
        padding: 5px 10px 5px 17px;
    }

    .option-list:hover { background: #a0a0a0; }

    .title-select{
        position: relative;
        cursor: pointer;
        width: 200px;
        z-index: 1500;
        display: flex;
        height: 38px;
        text-align: left;
        font-size: 18px;
        line-height: 19px;
        background-color: #a0a0a0;
        color: white;
        border: 0;
        border-radius: 10px 10px 10px 10px;
        padding: 10px 0 9px 12px;
    }

    .options-select{
        position: absolute;
        left: 0;
        top: 20px;
        width: 190px;
        overflow: hidden;
        z-index: 1450;
        background-color: #b3b3b3;
        border: 0;
        border-radius: 10px;
        padding: 20px 0 15px;
    }

</style>
