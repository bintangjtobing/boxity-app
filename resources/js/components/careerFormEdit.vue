<template>
    <div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">job vacancy <span>- {{job.title}}</span></h4>
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
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <input type="text"
                                                class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                v-model="job.title" id="formGroupExampleInput"
                                                placeholder="Job vacancy title" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select v-model="job.location"
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select">
                                                <option value="" disabled>Job location</option>
                                                <option v-bind:value="`Medan`">Medan</option>
                                                <option v-bind:value="`Jakarta`">Jakarta</option>
                                                <option v-bind:value="`Palembang`">Palembang
                                                </option>
                                                <option v-bind:value="`Surabaya`">Surabaya
                                                </option>
                                                <option v-bind:value="`Makassar`">Makassar
                                                </option>
                                                <option v-bind:value="`Bali`">Bali
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select v-model="job.divisi"
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select">
                                                <option value="" disabled>Department</option>
                                                <option v-bind:value="`Antar-Pulau`">Antar-Pulau</option>
                                                <option v-bind:value="`Ekspor`">Ekspor</option>
                                                <option v-bind:value="`Impor`">Impor</option>
                                                <option v-bind:value="`Trucking`">Trucking
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select v-model="job.part"
                                                class="form-control form-control-default ih-medium ip-gray radius-xs b-light fa-select">
                                                <option value="" disabled>Part of</option>
                                                <option v-bind:value="`Personalia Umum`">Personalia Umum
                                                </option>
                                                <option v-bind:value="`Finance`">Finance
                                                </option>
                                                <option v-bind:value="`Document`">Document
                                                </option>
                                                <option v-bind:value="`Operational`">Operational
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <editor
                                        placeholder="Requirements / Decriptions / Qualification / Job descriptions. Press `CTRL + ENTER` to send the comment."
                                        v-model="job.description" @keydown.enter="handleSubmit"
                                        api-key="8ll77vzod9z7cah153mxwug6wu868fhxsr291kw3tqtbu9om" :init="{
                                                                height: 300,
                                                                menubar: false,
                                                                branding: false,
                                                                toolbar:
                                                                    'undo redo | formatselect | bold italic backcolor | \
                                                                    alignleft aligncenter alignright alignjustify | \
                                                                    bullist numlist outdent indent | removeformat'
                                                        }" />
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
            return 'New job vacancy';
        },
        data() {
            return {
                job: {
                    location: '',
                    divisi: '',
                    part: '',
                },
            }
        },
        created() {
            this.loadDataCareer();
        },
        methods: {
            async loadDataCareer() {
                const resp = await axios.get('/api/career/' + this.$route.params.id);
                this.job = resp.data;
            },
            async handleSubmit() {
                await axios.patch('/api/career/' + this.$route.params.id, {
                    title: this.job.title,
                    location: this.job.location,
                    divisi: this.job.divisi,
                    partof: this.job.part,
                    desc: this.job.description
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Success update job vacancy.',
                });
                this.$router.push('/career/' + this.$route.params.id);
            }
        },
    }

</script>
