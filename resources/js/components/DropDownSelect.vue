<template>
    <div class="container position-relative">
        <div class="position-relative">

            <form id="Form for search the coach" action="/coach/list" method="post">
                <input type="hidden" name="_token" v-bind:value="csrf">
                <!-- Block dropdown menus -->
                <div class="d-block" style="padding: 2vw;">
                    <div class="spacer10">&nbsp;</div>

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
                    </div>

                </div>

                <div class="spacer40">&nbsp;</div>
                <p class="f-rate_public_profile position-relative">Durée d’abonnement</p>

                <div class="filter_section_container d-block text-left">
                    <div class="d-block" style="padding: 2px;">
                        <input type="radio" name="duration" id="week" value="week" class="css-checkbox" checked >
                        <label for="week" name="week_lbl" class="f-reg css-label check-x" >Semaine</label>
                    </div>
                    <div class="d-block" style="padding: 2px;">
                        <input type="radio" name="duration" id="month" value="month" class="css-checkbox" >
                        <label for="month" name="month_lbl" class="f-reg css-label check-x">Mois</label>
                    </div>
                </div>

                <div class="form-button-container d-block position-relative">
                    <button type="submit" class="yootyButt form-button">Rechercher</button>
                </div>

            </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "DropDownSelect",
        props: [
            'options_science',
            'options_education',
        ],

        data: function() {
            return {
                //csrf token
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                optionsVisibleScience: false,
                optionsVisibleEducation: false,
                selectScience: 'Matiére',
                selectEducation: 'Niveau',
            }
        },

        mounted() {
            //console.log('Droplists mounted')
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
