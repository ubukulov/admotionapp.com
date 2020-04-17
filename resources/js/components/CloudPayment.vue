<template>
    <div>
        <div class="form-group">
            <input type="text" v-model="amount" class="form-control" placeholder="Введите сумму">
        </div>

        <div class="form-group">
            <label>Выберите партнера</label>
            <select v-model="partner_id" class="form-control">
                <option v-for="p in partners" :value="p.id">{{ p.title }}</option>
            </select>
        </div>

        <div class="form-group">
            <button type="button" @click="createPayment()" class="btn btn-success">Оплатить сейчас</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data(){
            return {
                partner_id: "",
                amount: "",
            }
        },
        props: {
            partners: Array,
        },
        methods: {
            createPayment() {
                // let form_data = new FormData();
                // form_data.append('partner_id', this.partner_id);
                // form_data.append('amount', this.amount);

                //let form_data = new FormData();

                axios.post('https://api.cloudpayments.ru/test',
                    {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencode',
                            }
                        },
                        {
                            auth: {
                                username: 'pk_21387d1b5966c5fae5df1f7a58bf8',
                                password: '01c0f94586fc6131ce571aa280c28a04'
                            }
                        })
                    .then(res => {
                        console.log(res)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        }
    }
</script>
