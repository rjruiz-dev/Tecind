<template>
   <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">{{ notifications.length }}</span>
        </a>
        <ul class="dropdown-menu">            
            <li class="header">Tienes notificaciones</li>
            <div v-if="notifications.length">
                <li  v-for="item in listar" :key="item.id">
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                        <li  ><!-- start notification -->
                            <a href="#">
                                <i class="fa fa-check-square text-aqua"></i>&nbsp;{{ item.orders.msj }}&nbsp;
                                <span class="badge badge-success">&nbsp;{{ item.orders.numero }}</span>
                            </a>
                        </li>
                        <!-- end notification -->
                    </ul>
                </li>
            </div>
             <div v-else>
                <a><span>No tienes notificaciones</span></a>
            </div>
            <!-- <li class="footer"><a href="#">View all</a></li> -->
        </ul>
    </li>
</template>

<script>
export default {
    // se declara el props notifications
    props : ['notifications'],
    data (){
        return {
            arrayNotifications: []
        }
    },
     computed:{
        listar: function(){
            // acceder a la ultima notificacion con array 0
            // return this.notifications[0];
            this.arrayNotifications = Object.values(this.notifications[0]);
            if (this.notifications == '') {
                return this.arrayNotifications = [];
            } else {
                // capturo la ultima notificacion agregada
                this.arrayNotifications = Object.values(this.notifications[0]);
                // validacion por indice fuera de rango
                if (this.arrayNotifications.length > 3) {
                    // si el tamaño es > 3 es cuando las notificaciones son obtenidas desde el  mismo servidor consulta axios
                    return Object.values(this.arrayNotifications[4]);
                } else {
                    // si el tamaño es < 3 es cuando las notificaciones son obtenidas desde el canal privado laravel echo y pusher 
                    return Object.values(this.arrayNotifications[0]);
                }
            }            
        }
    } 
}
</script>