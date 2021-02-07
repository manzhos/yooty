<template>
    <div class="container">
        <div class="position-relative">

            <form action="/profile/addskill" method="post" role="form" id="compte-form">
                <input type="hidden" name="_token" v-bind:value="csrf">
                <!-- Block dropdown menus -->
                <div class="d-block">

                    <!-- drop menu for Matiére -->
                    <div class="d-inline-block position-relative">
                        <div class="title-select" @click="optionsVisibleScience = !optionsVisibleScience">
                            <span>{{selectScience}}</span>
                            <div class="select_icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="options-select" v-show="optionsVisibleScience">
                            <div v-for="option_science in options_science" @click="selectOptionScience(option_science)">
                                <input name="science" hidden v-bind:id="'science_'+option_science.id" type="radio" v-bind:value="option_science.id" />
                                <label v-bind:for="'science_'+option_science.id" class="select_label d-block select_item option-list">{{option_science.science_name}}</label>
                            </div>
                        </div>

                        <!-- input for Tarif Week -->
                        <div v-show="options_prof">
                            <div class="spacer20">&nbsp;</div>
                            <input type="text" id="tarif_week" name="tarif_week" class="f-reg caps my_profile_input text-center w-100" style="max-width: 144px; margin: 0 0 0 auto;" placeholder="Prix semaine, €" />
                        </div>

                    </div>

                    <!-- drop menu for Niveau -->
                    <div class="d-inline-block position-relative">
                        <div class="title-select" @click="optionsVisibleEducation = !optionsVisibleEducation">
                            <span>{{selectEducation}}</span>
                            <div class="select_icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="options-select" v-show="optionsVisibleEducation">
                            <div v-for="option_education in options_education" @click="selectOptionEducation(option_education)">
                                <input name="education" hidden v-bind:id="'education_'+option_education.id" type="radio" v-bind:value="option_education.id" />
                                <label v-bind:for="'education_'+option_education.id" class="select_label d-block select_item option-list">{{option_education.education}}</label>
                            </div>
                        </div>

                        <!-- input for Tarif Month -->
                        <div v-show="options_prof">
                            <div class="spacer20">&nbsp;</div>
                            <input type="text" id="tarif_month" name="tarif_month" class="f-reg caps my_profile_input text-center w-100" style="max-width: 144px; margin: 0 auto 0 0;" placeholder="Prix mois, €" />
                        </div>

                    </div>

                </div>

                <!-- SUBMIT -->
                <div class="spacer20">&nbsp;</div>
                <input type="submit" class="blank-button profile-text underline" value="Ajouter" />

            </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "AddSkill",
        props: [
            'options_science',
            'options_education',
            'options_prof'
        ],

        data: function() {
            return {
                //csrf token
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                optionsVisibleScience: false,
                optionsVisibleEducation: false,
                selectScience: 'Matiére',
                selectEducation: 'Niveau',
                tarif_month: '',
                tarif_week: '',
            }
        },

        mounted() {
            if(this.options_prof === 'true') { this.options_prof = true }
            else{ this.options_prof = false }
        },

        methods: {

            selectOptionScience: function (option_science) {
                this.optionsVisibleScience = false;
                this.selectScience = option_science.science_name;
            },
            selectOptionEducation: function (option_education) {
                this.optionsVisibleEducation = false;
                this.selectEducation = option_education.education;
            }

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
        width: 145px;
        z-index: 100;
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
        width: 145px;
        overflow: hidden;
        z-index: 90;
        background-color: #b3b3b3;
        border: 0;
        border-radius: 10px;
        padding: 20px 0 15px;
    }

</style>
