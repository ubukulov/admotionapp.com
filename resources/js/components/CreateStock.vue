<template>
    <div>
        <div id="create_stock" class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Категория</label>
                    <select v-model="category_id" class="form-control">
                        <option v-for="cat in cats" :value="cat.id">{{ cat.title }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Выберите тип</label>
                    <select v-model="stock_type" class="form-control">
                        <option value="0">Подарок</option>
                        <option value="1">Кэшбэк</option>
                        <option value="2">Промокод</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Наименование акции</label>
                    <input type="text" v-model="title" class="form-control">
                </div>

                <div class="form-group">
                    <label>Краткое описание</label>
                    <textarea v-model="short_description" class="form-control" cols="30" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Телефон</label>
                    <input type="text" v-model="phone" class="form-control">
                </div>


            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Начало</label>
                    <VueCtkDateTimePicker
                            v-model="start"
                            format="YYYY-MM-DD"
                            :only-date="true"
                            label="Выберите дату и время"/>
                </div>

                <div class="form-group">
                    <label>Конец</label>
                    <VueCtkDateTimePicker
                            v-model="end"
                            format="YYYY-MM-DD"
                            :only-date="true"
                            label="Выберите дату и время"/>
                </div>

                <div class="form-group">
                    <label>Изображение</label>
                    <input type="file" @change="processFile" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Опуб.</label>
                    <select v-model="active" class="form-control">
                        <option value="0">Нет</option>
                        <option value="1">Да</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Полное описание</label>
                    <textarea v-model="full_description" id="full_description" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" @click="createStock" class="btn btn-dark"><i class="fa fa-edit"></i>&nbsp;сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
    import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
    export default {
        components: {
            VueCtkDateTimePicker
        },
        data(){
            return {
                category_id: 1,
                stock_type: 0,
                title: '',
                short_description: '',
                phone: '',
                active: 0,
                start: '',
                end: '',
                file: '',
                full_description: '',
            }
        },
        props: {
            cats: Array,
        },
        methods: {
            createStock(){
                let form_data = new FormData();
                form_data.append('category_id', this.category_id);
                form_data.append('stock_type', this.stock_type);
                form_data.append('title', this.title);
                form_data.append('short_description', this.short_description);
                form_data.append('phone', this.phone);
                form_data.append('active', this.active);
                form_data.append('start', this.start);
                form_data.append('end', this.end);
                form_data.append('file', this.file);
                form_data.append('full_description', this.full_description);

                axios.post('/partner/stocks/store', form_data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(res => {
                        console.log(res);
                        window.location = '/partner/stocks';
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            processFile(event) {
                this.file = event.target.files[0]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
