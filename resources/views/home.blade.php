<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

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
            >
                <v-app-bar-nav-icon @click.stop="drawer = !drawer;"></v-app-bar-nav-icon>
                <v-toolbar-title class="text-primary">iHealth</v-toolbar-title>
            </v-app-bar>

            <v-content>
                <v-container
                    fluid
                >

                    <router-view></router-view>



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
