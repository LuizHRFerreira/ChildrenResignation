<template>
    <div>
        <!--
            This is the qrcode-vue component that will display the QR code.
            :value="value": The value to be encoded in the QR code (passed from the parent).
            :size="300": The size of the QR code (300x300 pixels).
            level="H": The error correction level (H = high).
            render-as="svg": Renders the QR code as an SVG image.
         -->
        <qrcode-vue :value="value" :size="300" level="H" render-as="svg" />
    </div>
</template>

<script>
    import QrcodeVue from 'qrcode.vue';

    export default {
        name: 'QRGenerator', // Recommended: Give your component a name
        components: {
            QrcodeVue,
        },
        props: {
            value: {
                type: String,
                required: true, // Now it's required
            },
        },
        // Now we don't need data() or watch, because we are using the prop directly.
    };
</script>
