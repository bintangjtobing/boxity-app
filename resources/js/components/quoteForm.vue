<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">new quote</h4>
                </div>
            </div>
        </div>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-Vertical card-default card-md mb-4">
                        <div class="card-body pb-md-30">
                            <div class="Vertical-form">
                                <div class="form-group">
                                    <textarea v-model="quote.quoteid" class="form-control"
                                        placeholder="Quote bahasa Indonesia" id="" cols="30" rows="10"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="quote.quoteen" class="form-control"
                                        placeholder="Quote bahasa Inggris" id="" cols="30" rows="10"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-row justify-content-end">
                                        <div class="layout-button mt-25">
                                            <button type="submit"
                                                class="btn btn-success btn-default btn-squared px-30">submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        components: {
            'editor': Editor
        },
        title() {
            return 'New quote';
        },
        data() {
            return {
                quote: {},
            }
        },
        methods: {
            async handleSubmit() {
                await axios.post('/api/quote', this.quote);
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success add new quote.',
                });
                this.$router.push('/quote');
            }
        },
    }

</script>
