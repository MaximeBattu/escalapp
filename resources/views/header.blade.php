@extends('layouts.app')
<!DOCTYPE html>
<html class="backgroundHtlm" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Escalapp</title>
    <!-- <link href="{{ asset('/css/style.css') }}" rel="stylesheet"> -->
    <!--<link rel="icon" type="image/png" href="ima ges/favicon.png" /> -->
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
  </head>
  <body>


<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal_content">
        <span class="close">&times;</span>
        <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png" alt="Aba pas de chance ca">
            <h1>S'identifier</h1>
        </div>

        <div class="">
            <label for="name">Pseudo :</label>
            <input type="text" id="name" name="name" required minlength="4" maxlength="8" size="10">
        </div>
        <div class="">
            <label for="name">Mot de passe :</label>
            <input type="text" id="name" name="name" required minlength="4" maxlength="8" size="10">
        </div>

        <div id="div_Input_Modal_Connect" class="">
            <input type="submit" name="valide" value="send">
        </div>
    </div>

</div>
