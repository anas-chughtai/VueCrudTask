@extends('layouts.master')

@section('title', 'Inquiries')
@section('styles')
    <style>
        .modal-mask {
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            display: table;
            transition: opacity .3s ease;
        }

        .modal-wrapper {
            display: table-cell;
            vertical-align: middle;
        }

        .modal-container {
            width: 300px;
            margin: 0px auto;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
            transition: all .3s ease;
            font-family: Helvetica, Arial, sans-serif;
        }

        .modal-header h3 {
            margin-top: 0;
            color: #42b983;
        }

        .modal-body {
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div id="vue-wrapper">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           required v-model="newInquiry.name" placeholder=" Enter some name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company Name:</label>
                                    <input type="text" class="form-control" id="company" name="company"
                                           required v-model="newInquiry.company" placeholder=" Enter Company name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           required v-model="newInquiry.email" placeholder=" Enter your email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                           required v-model="newInquiry.phone" placeholder=" Enter your Phone">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea id="message" name="message" class="form-control"
                                              required v-model="newInquiry.message"
                                              cols="10" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-block mb-2" @click="createInquiry()" >
                                    <span class="glyphicon glyphicon-plus"></span> ADD INQUIRY
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-center alert alert-danger" style="display: none"
                   v-bind:class="{ hidden: hasError }">Please fill all fields!</p>
                <p class="text-center alert alert-danger" style="display: none"
                   v-bind:class="{ hidden: hasEmailError }">Please enter a valid email!</p>
                {{ csrf_field() }}
                <p class="text-center alert alert-success" style="display: none"
                   v-bind:class="{ hidden: hasDeleted }">Deleted Successfully!</p>
                <div class="table mt-5" id="table">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tr v-for="item in inquiries">
                            <td>@{{ item.id }}</td>
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.company }}</td>
                            <td>@{{ item.email }}</td>
                            <td>@{{ item.phone }}</td>
                            <td>@{{ item.message }}</td>
                            <td id="show-modal"
                                @click="showModal=true; setVal(item.id, item.name, item.company, item.email, item.phone, item.message)"
                                class="btn btn-info m-1">Edit</td>
                            <td @click.prevent="deleteInquiry(item)" class="btn btn-danger m-1">Delete</td>
                        </tr>
                    </table>
                </div>
                <modal v-if="showModal" @close="showModal=false">
                    <h3 slot="header">Edit Inquiry</h3>
                    <div slot="body">
                        <input type="hidden" disabled class="form-control" id="e_id" name="id"
                               required :value="this.e_id">
                        Name: <input type="text" class="form-control" id="e_name" name="name"
                                     required :value="this.e_name">
                        Company: <input type="text" class="form-control" id="e_company" name="company"
                                     required :value="this.e_company">
                        Email: <input type="text" class="form-control" id="e_email" name="email"
                                    required :value="this.e_email">
                        Phone: <input type="tel" class="form-control" id="e_phone" name="phone"
                                           required :value="this.e_phone">
                        Message: <input type="text" class="form-control" id="e_message" name="message"
                                           required :value="this.e_message">
                    </div>
                    <div slot="footer">
                        <button class="btn btn-default" @click="showModal = false">
                            Cancel
                        </button>
                        <button class="btn btn-info" @click="editInquiry()">
                            Update
                        </button>
                    </div>
                </modal>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="../../js/app.js"></script>
    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                default header
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">

                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">


                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>
@endsection
