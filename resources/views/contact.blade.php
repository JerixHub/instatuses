@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white px-5 py-5">
        <div class="col-md-12 title">
            <h3 class="text-danger">Don't be a stranger</h3>
            <h4>just say hello!</h4>
        </div>
        <div class="col-md-6 first-column">
            <p>
                Feel free to get in touch with us. We are always open to discussing new projects, creative ideas or opportunity to be part of your visions.
            </p>
            <br>
            <p class="details">
                <small>Need Help?</small>
                <a href="#">Tag's Creatives</a>
            </p>
            <p class="details">
                <small>Feel like talking?</small>
                <a href="#">+6312345123</a>
            </p>
        </div>
        <div class="col-md-6 second-column">
            <form action="#" method="post">
                @csrf
                <div class="form-group">
                    <input type="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description" style="resize: none;"></textarea>
                </div>
                <button class="btn btn-danger" type="submit">
                    Send over
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .title{
        margin-bottom: 30px;
    }
    .title h3{
        font-family: Nunito;
        font-weight: bold;
        font-size: 2.6em;
    }
    .title h4{
        font-family: Nunito;
        font-weight: bold;
        font-size: 2.6em;
    }

    .first-column p{
        font-family: Nunito;
        color: #888;
        font-size: 17px;
    }

    .first-column p.details small{
        display: block;
        color: #aaa;
    }

    .first-column p.details a{
        color: #333;
        font-weight: bold;
    }
</style>
@endsection