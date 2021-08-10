    <template>
        <section>
            <div class="button" @click="show" :style="isSidebar ? `` : `height: 42px `" @mouseover="content = true"
                @mouseleave="content = false">
                <span class="material-icons-outlined nav-icon icon" style="color: #eda260"
                    :style="routerLink ? `margin: 0 14px 0 0` : `margin: 0 10px 0 0`">{{ icon }}</span>
                <span class="menu menu-text">{{ title }}</span>
            </div>
            <div class="expandable" :style="isSidebar ? { height: heightContent + 'px' } : `height: 0`">
                <slot />
            </div>
            <div class="content" v-show="content && !isSidebar && !routerLink" @mouseover="content = true"
                @mouseleave="content = false">
                <div class="value">
                    <slot />
                </div>
            </div>
        </section>
    </template>

    <script>
        export default {
            props: ["title", "icon", "routerLink", "isSidebar", "listId"],
            data: function () {
                return {
                    content: false,
                    isShow: true,
                    heightContent: 0,
                    heightTemp: 0,
                };
            },
            // watch: {
            //   printOut () {
            //     if (this.group) {
            //       return this.group + " - " + this.name
            //     }
            //     return this.name
            //   }
            // },
            // created: function () {
            //   this.item = this.submitted ? "" : this.item;
            // },
            // created: function () {
            //   this.log();
            // },
            computed: {},
            mounted() {
                // console.log(this.height)
                this.cong();
            },
            methods: {
                cong() {
                    this.heightTemp = this.listId ?
                        document.getElementById(this.listId).offsetHeight :
                        0;
                    this.heightContent = this.heightTemp;
                },
                show() {
                    // console.log('coba:',this.$refs.coba.clientHeight, ', id:',document.getElementById(this.id).offsetHeight, ' content:', this.heightContent)
                    this.isShow = !this.isShow;
                    this.heightContent = this.isShow ? this.heightTemp : 0;
                },
            },
        };

    </script>

    <style scoped>
        section {
            width: 100%;
            cursor: pointer;
        }

        .button {
            background: #fff;
            color: #262729;
            display: flex;
            align-items: center;
            padding: 10px 2rem;
            position: relative;
        }

        .button:hover {
            background: rgba(5, 5, 7, 0.05);
        }

        .content {
            display: block;
            position: absolute;
            top: 0;
            left: 75px;
            z-index: 99;
            cursor: context-menu;
            padding-left: 7px;
        }

        .content .value {
            text-align: left !important;
            display: block;
            background: #fff;
            width: 14em;
            padding: 7px;
        }

        .menu {
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .expandable {
            background: #fff;
            overflow: hidden;

            transition: all 0.2s ease-in-out;
            height: 0;
            margin: 0 1.75rem;
        }

    </style>
