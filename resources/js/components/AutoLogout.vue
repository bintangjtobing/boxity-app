<template>
    <div v-if="warningZone">
        Are you still with us?
    </div>
</template>
<script>
    import Swal from 'sweetalert2';

    export default {
        name: "AutoLogout",
        data() {
            return {
                events: ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],
                warningTimer: null,
                logoutTimer: null,
                warningZone: false,
                warnTime: 4000,
                logTime: 20000,
            }
        },
        mounted() {
            this.events.forEach(function (event) {
                window.addEventListener(event, this.resetTimer);
            }, this);
            this.setTimers();
        },

        destroyed() {
            this.events.forEach(function (event) {
                window.removeEventListener(event, this.resetTimer);
            }, this);
            this.resetTimer();
        },

        methods: {
            setTimers: function () {
                this.warningTimer = setTimeout(this.warningMessage, this.warnTime);
                this.logoutTimer = setTimeout(this.logoutUser, this.logTime);

                this.warningZone = false;
            },
            warningMessage: function () {
                let timerInterval
                Swal.fire({
                    icon: 'info',
                    title: 'Do you still with us?',
                    html: 'System will close in <b></b> milliseconds.',
                    timer: this.logTime,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    },
                    showDenyButton: true,
                    denyButtonText: 'Yeah, sure!',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success')
                    } else if (result.isDenied) {
                        this.events.forEach(function (event) {
                            window.removeEventListener(event, this.resetTimer);
                        }, this);
                        this.resetTimer();
                    }
                });
            },
            logoutUser: function () {
                window.location.href = '/sign-out';
            },
            resetTimer: function () {
                clearTimeout(this.warningTimer);
                clearTimeout(this.logoutTimer);
                this.setTimers();
            }
        },
    }

</script>
