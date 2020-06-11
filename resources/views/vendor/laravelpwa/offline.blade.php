@extends('layouts.app')
@section('styles')
    <style>
        main {
            margin-top: 80px;
        }
    </style>
@endsection
@section('content')

    <v-card>
        <v-layout column class="align-center">
            <v-flex>
                <v-btn class="warning info my-5"> I have a good news and bad news</v-btn>
            </v-flex>
            <v-flex>
                <v-btn text color="indigo" class="my-5">
                    The bad news is that you are currently not connected to any network.
                </v-btn>
            </v-flex>
            <v-flex>
                <v-btn text color="indigo" class = "my-5">
                    The good news is that you are amazing. Never forget that.
            </v-btn>
            </v-flex>
        </v-layout>
        
    </v-card>

@endsection