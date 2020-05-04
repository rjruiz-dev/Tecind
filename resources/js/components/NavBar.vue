<template>
    <div>
        <nav class="custom-wrapper" id="menu">
            <div class="pure-menu"></div>			
            <ul class="container-flex list-unstyled">					
                <li>							
                    <router-link :to="{name: 'home'}" class="pure-menu-link c-gris-2 text-uppercase">
                        Inicio
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'about'}"	class="pure-menu-link c-gris-2 text-uppercase">
                        Nosotros
                    </router-link>							
                </li>
                <li>
                    <router-link :to="{name: 'archive'}"	class="pure-menu-link c-gris-2 text-uppercase">
                        Archivo
                    </router-link>	
                </li>
                <li>
                    <router-link :to="{name: 'contact'}"	class="pure-menu-link c-gris-2 text-uppercase">
                        Contacto
                    </router-link>	
                </li>
            </ul>           
        </nav>	
    </div>
</template>