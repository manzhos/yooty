<template>
    <div class="container zero">

        <!-- show comments -->
        <div id="mobchat-body">
            <div v-for="comment in comments">
                <div style="padding: 0 50px 0 50px" class="aniblock">
                    <div class="spacer10"></div>
                    <!-- Two type of comment: Authors and Prof -->
                    <div v-if="user_auth_id === comment.user_id">
                        <!-- the comment from author -->
                        <div class="row justify-content-end">
                            <div class="f-reg comment comment-auth col-9">

                                <!-- image of comment -->
                                <div v-for="image in images" style="margin-bottom: 10px;">
                                    <div v-if="comment.id === image.comment_id" style="height: 20vh; overflow: hidden">
                                        <!-- preview image in comments list -->
                                        <a href="#" @click="showImg.splice(image.id, 1, !showImg[image.id])">
                                            <img v-bind:src="'/storage/uploads/' + image.file_name" style="width:100%; height:auto;"/>
                                        </a>

                                        <!-- fullscreen image -->
                                        <div class="position-fixed full-image-container" v-show="showImg[image.id]">
                                            <div class="text-center">
                                                <div class="d-block">
                                                    <button type="button" class="close" style="margin: 0 10px;" @click="showImg.splice(image.id, 1, !showImg[image.id])" aria-label="Close">
                                                        <span aria-hidden="true" style="color:white;">&times;</span>
                                                    </button>
                                                    <img v-bind:src="'/storage/uploads/' + image.file_name" class="maximg"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- text of comment -->
                                <span>{{comment.body}}</span>

                                <!-- Comment Button Block -->
                                <div class="spacer10">&nbsp;</div>
                                <div class="edit-btn-block">
                                    <!-- EDIT Comment -->
                                    <!-- Button  -->
                                    <a href="#" class="yooty-edit-BTN yooty-btn-link yooty-BTN-comment d-inline-block" @click="showEdit.splice(comment.id, 1, !showEdit[comment.id])">
                                        Éditer
                                    </a>
                                    <!-- Edit windows -->
                                    <div class="position-fixed full-image-container" v-show="showEdit[comment.id]">
                                        <div class="modal-dialog-centered w-100" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-boldSE" id="exampleModalLongTitle">Modifier la réponse</h5>
                                                    <button type="button" class="close" data-dismiss="modal" @click="showEdit.splice(comment.id, 1, !showEdit[comment.id])" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- EDIT Comment Form-->
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div>
                                                                <textarea class="form-control-textarea" v-model="comment.body">{{ comment.body }}</textarea>
                                                            </div>
                                                            <div class="spacer10"></div>
                                                            <button type="submit" class="yootyButt form-button" @click="saveCommentChanges(comment.id, comment.body)">Sauvers</button>
                                                            <button type="button" class="btn btn-secondary" @click="showEdit.splice(comment.id, 1, !showEdit[comment.id])" >Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="spacer10_right"></div>
                                    <!-- DELETE Comment -->
                                    <div @click="deleteComment(comment.id)" class="yooty-del-BTN yooty-btn-link yooty-BTN-comment" style="display:inline-block; cursor: pointer;">Supprimer</div>
                                </div>
                                <!-- END Comment Button Block -->

                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <!-- the comment from prof -->
                        <div class="row justify-content-start">
                            <div class="f-reg comment comment-assistant col-9">

                                <!-- image of comment -->
                                <div v-for="image in images" style="margin-bottom: 10px;">
                                    <div v-if="comment.id === image.comment_id" style="height: 20vh; overflow: hidden">
                                        <!-- preview image in comments list -->
                                        <a href="#" @click="showImg.splice(image.id, 1, !showImg[image.id])">
                                            <img v-bind:src="'/storage/uploads/' + image.file_name" style="width:100%; height:auto;"/>
                                        </a>

                                        <!-- fullscreen image -->
                                        <div class="position-fixed full-image-container" v-show="showImg[image.id]">
                                            <div class="text-center">
                                                <div class="d-block">
                                                    <button type="button" class="close" style="margin: 0 10px;" @click="showImg.splice(image.id, 1, !showImg[image.id])" aria-label="Close">
                                                        <span aria-hidden="true" style="color:white;">&times;</span>
                                                    </button>
                                                    <img v-bind:src="'/storage/uploads/' + image.file_name" class="maximg"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- text of comment -->
                                <span>{{comment.body}}</span>
                            </div>
                        </div>

                    </div>
                    <div class="w-100 d-block position-relative" style="float: left;"><div class="spacer10">&nbsp;</div></div>
                </div>
            </div>
            <div class="spacer80">&nbsp;</div>
        </div>

        <!-- add/send new comments for the message -->
        <div v-if="terminate === 0" class="send-comment-body-mob">
            <div class="w-100 conv-send position-relative">
                <div id="file-uploader" class="d-inline-block">
                    <!-- uploading media if need -->
                    <input id="files" class="inputfile upload-media-input" type="file" ref="files" multiple v-on:change="handleFileUpload()"/>
                    <label for="files" class="d-inline-block"><span><img v-bind:src="imgPath" width="38" height="38" /></span></label>
                </div>
                <div class="block-type-send-comment d-inline-block">
                    <!-- typing comment -->
                    <input type="text" class="ctrlSubmit comment-textarea" v-model="textMessage" @keyup.enter="sendMessage" placeholder="tapez le commentaire...">

                    <!-- sending comment -->
                    <div class="position-absolute" style="top: 0; right: 0;">
                        <input type="submit" class="send-btn blank-button" value="" v-on:click="sendMessage">
                    </div>

                </div>
            </div>
        </div>
        <div v-else class="send-comment-body-mob">
            <div class="w-100 conv-send position-relative">
                <span>Le chat est fermé</span>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Chat",
        props: [
            'room_id',
            'user_auth_id',
            'terminate'
        ],

        data: function() {
            return {
                //csrf token
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                comments: [],
                textMessage: '',
                files: '',
                images: [],
                imgPath: '/images/camera.svg',
                showImg:[1000],
                showEdit:[1000],
                id: '',
                name: '',
                body: '',
            }
        },

        mounted() {
            //console.log('CHAT MOUNTED')

            this.path = '/getcomments?id=' + this.room_id;
            axios.get(this.path).then((getResponse) => {
                this.comments = getResponse.data;
            });

            axios.get('/getimages').then((getResponse) => {
                this.images = getResponse.data;
            });

            for(let i=0; i<1000; i++){ Vue.set(this.showImg, i, false); };
            for(let i=0; i<1000; i++){ Vue.set(this.showEdit, i, false); };

            this.ShowComments();

        },

        updated() {
            var bott = document.getElementById('bottom-div');
            bott.scrollIntoView({behavior: "smooth"});
        },

        methods: {

            ShowComments: function () {
                //console.log('ShowComments for message ' + this.room_id + ' is mounted')

                Echo.private('UsersChat') //+this.room_id
                    .listen('NewMessage', () => {
                        axios.get(this.path).then((getResponse) => {
                            this.comments = getResponse.data;
                        });
                        axios.get('/getimages').then((getResponse) => {
                            this.images = getResponse.data;
                        });
                    });

            },

            sendMessage() {

                let formData = new FormData();
                for( var i = 0; i < this.files.length; i++ ){
                    let file = this.files[i];
                    formData.append('file[' + i + ']', this.files[i]);
                }
                formData.append('message_id', this.room_id);
                formData.append('body', this.textMessage);
                axios.post( '/messages/comments',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                    //console.log('SUCCESS!!');
                })
                .catch(function(){
                    //console.log('FAILURE!!');
                });

                this.textMessage = '';
                this.imgPath = '/images/camera.svg';

                axios.get(this.path).then((getResponse) => {
                    this.comments = getResponse.data;
                });
                axios.get('/getimages').then((getResponse) => {
                    this.images = getResponse.data;
                });

            },

            handleFileUpload(){
                this.imgPath = 'https://repotestplatform5937.yooty.io/images/ok.svg';
                this.files = this.$refs.files.files;
                //console.log(this.files.length);
            },

            deleteComment(id){
                axios.get('/comment/delete?comment_id=' + id)
                    .then(function(){
                    //console.log('SUCCESS!!');
                })
                    .catch(function(){
                        //console.log('FAILURE!!');
                });

                axios.get(this.path).then((getResponse) => {
                    this.comments = getResponse.data;
                });
                axios.get('/getimages').then((getResponse) => {
                    this.images = getResponse.data;
                });
            },

            saveCommentChanges(id, body){
                this.showEdit.splice(id, 1, !this.showEdit[id])

                console.log(id, ' :::: ', body);

                let formData = new FormData();
                formData.append('body', body);
                formData.append('comment_id', id);

                axios.post('/comment/edit',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                    //console.log('SUCCESS!!');
                }).catch(function(){
                    //console.log('FAILURE!!');
                });

                axios.get(this.path).then((getResponse) => {
                    this.comments = getResponse.data;
                });
                axios.get('/getimages').then((getResponse) => {
                    this.images = getResponse.data;
                });
            },

        }

    }

</script>

<style scoped>

    .full-image-container{
        width: 100vw;
        height: 100vh;
        top:0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1050;
        padding: 5%;
    }

</style>
