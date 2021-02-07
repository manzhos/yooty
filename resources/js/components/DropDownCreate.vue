<template>
    <div class="container">

        <div class="position-relative">

            <form class="form-vertical input-form" action="/messages/store" method="post" role="form" enctype="multipart/form-data" >
                <input type="hidden" name="_token" v-bind:value="csrf">
                <div class="row align-items-end">
                    <div class="col-md-7">
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

                        <div class="spacer40"></div>

                        <div>
                            <label for="subject">Titre</label>
                            <input name="subject" id="subject" class="form-control" placeholder="Titre">
                        </div>

                        <div class="spacer20"></div>

                        <div>
                            <label for="message">Description</label>
                            <textarea name="message" id="message" class="form-control-textarea" v-model="message" placeholder="Veillez à être concis dans vos propos, mais précis">{{ message }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-5" style="margin-top:40px;">
                        <!-- ADD doc's to message -->
                        <div class="text-center">

                            <!-- block for preview image -->
                            <div class="img_wrapper">
                                <div id="preview_id"></div>
                            </div>
                            <div class="spacer10"></div>
                            <div class="f-reg">Ajouter des photos (Optionnel)</div>
                            <div class="spacer20"></div>
                            <div id="file-uploader">
                                <!-- uploading media if need -->
                                <input id="add_media_btn" class="inputfile upload-media-input" type="file" preview-target-id="preview_id" name="file[]" data-multiple-caption="{count} files selected" multiple ref="file" v-on:change="handleFileUpload()" />
                                <label for="add_media_btn" class=""><span><img v-bind:src="imgPath" width="38" height="38" /></span></label>
                            </div>
                        </div>

                        <div class="spacer35"></div>
                        <!-- END form ADD doc's to message -->
                        <div class="text-center">
                            <button type="submit" class="yootyButt form-button">Suivant</button>
                        </div>
                    </div>

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
                subject: '',
                message: '',
                imgPath: '/images/camera.svg',
            }
        },

        mounted() {
            //console.log('Droplists mounted')

            // the script for preview of loaded images
            $('input[type="file"][preview-target-id]').on('change', function() {
                var input = $(this)
                if (!window.FileReader) return false // check for browser support
                if (input[0].files && input[0].files[0]) {
                    var reader = new FileReader()
                    reader.onload = function (e) {
                        var target = $('#' + input.attr('preview-target-id'))
                        var background_image = 'url(' + e.target.result + ')'
                        target.css('background-image', background_image)
                        target.parent().show()
                    }
                    reader.readAsDataURL(input[0].files[0]);
                }
            })

        },

        methods: {

            handleFileUpload(){
                this.imgPath = 'https://repotestplatform5937.yooty.io/images/ok.svg';
            },

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

    .img_wrapper {
        height: 256px;
        width: 100%;
        background-color: #fefefe;
        /*border: dashed 1px #ccc;*/
    }
    .img_wrapper div {
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%; width: 100%;
    }

</style>
