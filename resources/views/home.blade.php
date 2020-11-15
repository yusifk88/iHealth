<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link href="/css/atlantis.min.css" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <style rel="stylesheet">
        [v-cloak] {
            display: none;
        }
        #HW_badge_cont {
            left: 15px !important;
            top: 1px !important;

        }
    </style>
</head>
<body>
<div id="app">
    <div id="app">
        <v-app id="inspire" v-cloak>
            <v-navigation-drawer
                v-model="drawer"
                app
                clipped
                floating
                v-if="!$store.state.initializing && $store.state.loged_in"
            >
                <v-list dense>
                    <v-list-item v-for="nav in navs" :to="nav.route">
                        <v-list-item-action>
                            <v-icon>@{{nav.icon}}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>@{{nav.text}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                </v-list>
            </v-navigation-drawer>

            <v-app-bar
                app
                clipped-left
                v-if="!$store.state.initializing && $store.state.loged_in"
                elevate-on-scroll

            >
                <v-app-bar-nav-icon @click.stop="drawer = !drawer;"></v-app-bar-nav-icon>
                <v-toolbar-title class="text-primary">iHealth</v-toolbar-title>

                <v-spacer>
                </v-spacer>
                <v-menu
                    v-model="menu"
                    :close-on-content-click="false"
                    :nudge-width="200"
                    offset-x
                    transition="slide-y-transition"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="indigo"
                            dark
                            v-bind="attrs"
                            v-on="on"
                            text
                        >
                            @{{$store.state.user.name}}
                        </v-btn>
                    </template>

                    <v-card>
                        <v-list>
                            <v-list-item>
                                <v-list-item-avatar>
                                    <img src="/img/photo.png" alt="User photo">
                                </v-list-item-avatar>

                                <v-list-item-content>
                                    <v-list-item-title>@{{$store.state.user.name}}</v-list-item-title>
                                    <v-list-item-subtitle class="text-success">@{{$store.state.user.type}}</v-list-item-subtitle>
                                </v-list-item-content>

                            </v-list-item>
                        </v-list>

                        <v-divider></v-divider>

                        <v-list rounded>
                            <v-list-item class="border text-primary border-1" @click="logout_dialog=true">

                                <v-list-item-title class="text-center text-danger">Logout</v-list-item-title>
                            </v-list-item>

                        </v-list>

                    </v-card>
                </v-menu>

            </v-app-bar>

            <v-content>
                <v-container
                    fluid
                >

                    <v-dialog width="500px" v-model="logout_dialog">
                        <v-card>
                            <v-card-text class="pt-5">
                                <h2>Do you want to logout?</h2>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red" :loading="logout_progress" @click="logout()" text>Logout</v-btn>
                            </v-card-actions>
                        </v-card>

                    </v-dialog>

                    <router-view
                        v-if="!$store.state.initializing"

                    ></router-view>

                </v-container>
            </v-content>

            <v-footer app>
                <span>&copy; 2020 iHealth</span>
            </v-footer>
        </v-app>
    </div>

</div>


</body>
</html>
