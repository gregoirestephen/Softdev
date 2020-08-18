<template>
    <div>
        <div class="overlay"></div>
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info"></div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU PRINCIPAL</li>
                    <li class="active">
                        <router-link to="/home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </router-link>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">list</i>
                            <span>Gestion des patients</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Assurances</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Basic</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Colored</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>No Header</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    Normal Tables
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    Jquery Datatables
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    Editable Tables
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Medias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    Image Gallery
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    Carousel
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    <li class="header">LABELS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 <a href="javascript:void(0);">Developed by Georges M for SoftdevSA</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

        <!-- right Sidebar-->

        <!-- #right Sidebar-->
    </section>
    </div>
</template>

<script>
    export default {
        props:['router'],
        data(){
            return{
            }
        },
        methods:{

        },
        computed:{


        }
    }
</script>

<style scoped>

</style>
