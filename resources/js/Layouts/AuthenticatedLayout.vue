<script setup>
    import { router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import { Link } from '@inertiajs/vue3';
    import { createPopper } from '@popperjs/core';
    import ThemeChanger from '@/Components/ThemeChanger.vue';

    import { onMounted, watch } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import { data } from 'autoprefixer';

    function logout() {router.post('/logout');}

    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };



    const rebootAdminLTE = () => {

        const oldScript = document.querySelector('script[src*="adminlte.js"]');
        if (oldScript) {
            oldScript.remove();
        }

        const script = document.createElement("script");
        script.src = "/js/adminlte.js";
        script.onload;
        document.body.appendChild(script);
    };

    const initializeSidebar = () => {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    };

    onMounted(() => {
        initializeSidebar();
        rebootAdminLTE();
    });

</script>

<template>
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <NavLink :href="route('message.index')" :active="route().current('message.index')">
                        <img src="../../../public/assets/img/ico.png" class="logo">
                        QRMessage
                    </NavLink>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <ThemeChanger />
                    </li>

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            Usuário
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            
                            <li class="user-footer">
                               
                                <NavLink class="btn btn-default btn-flat" :href="route('profile.edit')" :active="route().current('profile.edit')">
                                    Configueações
                                </NavLink>
                                <NavLink @click="logout" class="btn btn-default btn-flat">
                                    Sign out
                                </NavLink>

                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div v-if="$page.props.flash.message">
                                    <div class="alert alert-primary"
                                    :class="{
                                        'alert-success': $page.props.flash.type === 'success',
                                        'alert-danger': $page.props.flash.type === 'error',
                                        'alert-warning': $page.props.flash.type === 'warning',
                                        'alert-info': $page.props.flash.type === 'info',
                                    }" 
                                    role="alert">
                                        {{ $page.props.flash.message }}
                                    </div>
                                </div>
                                <slot />
                            </div>
                        </div> 
                    </div>                   
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

</template>

<style scoped>
    .logo{
        width:40px;
        height:40px;
    }
</style>