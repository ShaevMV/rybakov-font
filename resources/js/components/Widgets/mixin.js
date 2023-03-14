export const mixin = {
    props: ['title', 'params', 'item'],
    methods: {
        getData: function (index) {
            if (typeof this.params[index] !== "undefined") {
                return this.params[index];
            } else {
                console.error(this);
                console.error('Неполные данные!!!');
            }
        }
    },
};