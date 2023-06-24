<template>
    <div>        
        <HeaderLayout/>
         <router-view> </router-view>
        <FooterLayout/>
    </div>  
</template>
 
<script>  
    import HeaderLayout from './views/Layouts/header';    
    import FooterLayout from './views/Layouts/footer';  
    export default {
        components: {
            HeaderLayout,
            FooterLayout
        },
    }
</script>
