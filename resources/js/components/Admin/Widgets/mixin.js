export const mixin = {
    props: ['params', 'data_join','template','joinData'],
    data() {
        return {
            image: [],
            errorFile: [],
            delElem: []
        }
    },
    methods: {
        /**
         * Сохранить
         */
        save(){
            this.$emit('saveComponent',{}, this.template);
        },
        /**
         * Загрузить файл
         *
         * @param index
         */
        previewFiles(index) {
            let data = new FormData();

            let imagefile = document.querySelector('#'+this.template+'image'+index);

            data.append('file', imagefile.files[0]);
            let vm = this;
            axios.post('/api/v1/widget/loadImage', data,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                vm.setNewImage(index,response.data.file);
            }).catch(function (error) {
                vm.errorFile.push({
                    index: index,
                    message: error.response.data.error
                })
            });
        },
        /**
         * Вывести изображение
         *
         * @param index
         * @return {string}
         */
        getImage(index) {
            let newImage = _.find(this.image, function (item) {
                if (typeof item.key !== 'undefined' && item.key === index) {
                    return true;
                }
            });
            if (!newImage) {
                let oldImage = _.find(this.params, function (item) {
                    if (typeof item.key !== 'undefined' && item.key === index) {
                        return true;
                    }
                });
                return oldImage.params.image;
            } else {
                return newImage.file;
            }


        },
        /**
         * Вывести ошибку загрузки изображения
         *
         * @param index
         * @return {string}
         */
        getError(index) {
            let error = _.find(this.errorFile, function (item) {
                if (typeof item.index !== 'undefined' && item.index === index) {
                    return true;
                }
            });

            return error ? error.message : '';
        },
        /**
         * Пометить элемент на удаление
         *
         * @param index
         */
        del(index) {
            this.delElem = _.union([index], this.delElem);
        },
        /**
         * Восстановить элемент после удаления
         */
        restoreElem(key) {
            let indexElem = 0;
            this.delElem.forEach(function (item, index) {
                if(item === key) {
                    indexElem = index;
                }
            });
            this.delElem.splice(indexElem, 1);
        },
        /**
         * Показать элемент
         *
         * @param key
         * @return {boolean}
         */
        showElem(key) {
            let result = _.filter(this.delElem, function (item) {
                return item === key
            });
            return result.length === 0;
        },
        /**
         * Сохранить новое изображение
         *
         * @param key
         * @param newImage
         */
        setNewImage(key, newImage) {
            let find = false;
            this.image.forEach(function (item) {
                if (item.key === key) {
                    item.file = newImage;
                    find = true;
                }
            });
            if (!find) {
                this.image.push({
                    key: key,
                    file: newImage
                })
            }
        },
        /**
         * Вывести новые изображения для передачи на сервер
         *
         * @return {{}}
         */
        getNewImageForSave(){
            let result={};
            let vm = this;
            this.image.forEach(function (item) {
                if(vm.delElem.indexOf(item.key) === -1){
                    result[item.key] = item.file
                }
            });
            return result;
        }
    },
};