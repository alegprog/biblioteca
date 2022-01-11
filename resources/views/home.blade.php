@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!--<a class="navbar-brand" href="#">Menú</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <router-link to="/" class="nav-link" active-class="fw-bold" exact>
                    <span class="material-icons" style="vertical-align:top;">list_alt</span>    
                    Lista de Libros
                </router-link>
                
            </li>
            <li class="nav-item">
                <router-link to="/book/form" class="nav-link" active-class="fw-bold" exact>
                    <span class="material-icons" style="vertical-align:top;">playlist_add</span>    
                    Agregar Libro
                </router-link>
                
            </li>
            <li class="nav-item">
                <router-link to="/book/search" class="nav-link" active-class="fw-bold" exact>
                    <span class="material-icons" style="vertical-align:top;">search</span>    
                    Filtrar
                </router-link>
                
            </li>
            <li class="nav-item">
                <router-link to="/book/rent" class="nav-link" active-class="fw-bold" exact>
                    <span class="material-icons" style="vertical-align:top;">auto_stories</span>    
                    Rentar
                </router-link>
                
            </li>
            </ul>
        </div>
        </nav>
        <div class="col-md-8">
            <div class="row">
                <router-view></router-view>
            </div>
        </div>
    </div>
</div>
@endsection
