<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<style>
    .logo {
        width: 60px;
        margin-right: 4px;
    }
</style>

<style>
/* From Uiverse.io by AqFox */ 
.spinner {
 width: 44px;
 height: 44px;
 animation: spinner-y0fdc1 2s infinite ease;
 transform-style: preserve-3d;
}

.spinner > div {
 background-color: rgba(0,77,255,0.2);
 height: 100%;
 position: absolute;
 width: 100%;
 border: 2px solid #004dff;
}

.spinner div:nth-of-type(1) {
 transform: translateZ(-22px) rotateY(180deg);
}

.spinner div:nth-of-type(2) {
 transform: rotateY(-270deg) translateX(50%);
 transform-origin: top right;
}

.spinner div:nth-of-type(3) {
 transform: rotateY(270deg) translateX(-50%);
 transform-origin: center left;
}

.spinner div:nth-of-type(4) {
 transform: rotateX(90deg) translateY(-50%);
 transform-origin: top center;
}

.spinner div:nth-of-type(5) {
 transform: rotateX(-90deg) translateY(50%);
 transform-origin: bottom center;
}

.spinner div:nth-of-type(6) {
 transform: translateZ(22px);
}

@keyframes spinner-y0fdc1 {
 0% {
  transform: rotate(45deg) rotateX(-25deg) rotateY(25deg);
 }

 50% {
  transform: rotate(45deg) rotateX(-385deg) rotateY(25deg);
 }

 100% {
  transform: rotate(45deg) rotateX(-385deg) rotateY(385deg);
 }
}
</style>
<template>
    
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <img class="logo" src="../../../public/assets/img/AdminLTELogo.png" alt="">
                <span class="fs-4">Starter template</span>
            </a>
        </header>

        <main>
            <h1 class="text-body-emphasis">Get started with Inertia</h1>
            <p class="fs-5 col-md-8">Quickly and easily get started with Bootstrap's compiled, production-ready files
                with this barebones example featuring some basic HTML and helpful links. Download all our examples to
                get started.</p>


                <div class="text-center m-5">
                    <div class="spinner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    </div>
                </div>
        
            <div class="row g-5">
                <div class="col-md-6">
                    <h2 class="text-body-emphasis">Starter projects</h2>
                    <p>Ready to go beyond the starter template? Check out these open source projects that you can
                        quickly duplicate to a new GitHub repository.</p>
                    <ul class="list-unstyled ps-0">
                        <li>
                            <Link  :href="route('login')">
                            Login
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
        <footer class="pt-5 my-5 text-body-secondary border-top">
            Created by the Bootstrap team · © 2025
        </footer>
    </div>
</template>
