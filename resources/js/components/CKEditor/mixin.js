import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from 'axios';

class UploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(uploadedFile => {
                return new Promise((resolve, reject) => {
                    let data = new FormData();

                    data.append('file', uploadedFile);

                    data.append('temp', false);

                    let vm = this;
                    axios.post('/api/v1/widget/loadImage', data,{
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(response => {
                        resolve({
                            default: response.data.file
                        });

                    }).catch(response => {
                        reject ( 'Upload failed');
                    });

                });
            })
    }

    abort() {
    }
}

export const mixin = {
    data(){
        return {
            editorConfig: {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload'],
                extraPlugins: [
                    this.MyCustomUploadAdapterPlugin
                ],
                link: {
                    addTargetToExternalLinks: true,
                }
            },

            editor: ClassicEditor,
        };
    },
    methods: {
        MyCustomUploadAdapterPlugin ( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new UploadAdapter( loader );
            };
        },
    },
};