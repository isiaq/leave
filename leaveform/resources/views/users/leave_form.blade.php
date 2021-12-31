@extends('users.layouts.users_master')

@section('title') Leave Form @endsection

@section('header')
    <link rel="icon" type="image/x-icon" sizes="32x32" href="favicon.png">
    <script src="https://kit.fontawesome.com/10155896e6.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/leave_form.css">
@endsection

@section('content')

<div class="desktop moblie">
<main class="container">
    <form class="form-container" method="POST" action="{{url('doleave')}}">
        @csrf
        <header>

            <div id="grid">
                <div id="address">
                    <img src="/img/logo.jpg" style="height: 90px" >
                    <p><span class="bold">Headquarters</span><br>
                        BUA Towers<br>PC 32, Churchgate Street
                        P.O Box 70106 Victoria Island, Lagos,Nigeria<br>
                        <span class="bold">T. </span>+234 1 461 0669 <span class="bold">E. </span>info@buagroup.com
                    </p>
                </div><br class="m-hidden"/>
                <div id="leave">
                    <h3><span class="bold">LEAVE REQUEST FORM</span></h3>
                    <hr>
                    <p>RC 110076</p>
                </div>
                <div id="instr">
                    <p><span class="italic bold">VERY IMPORTANT</span></p>
                    <p class="italic">1. Staff are expected to give a<span class="bold"> NOTICE OF ONE WEEK </span>before commencement of annual leave</p>
                    <p class="italic">2. Staff should not proceed on leave<span class="bold"> UNTIL</span>they have received Approval Coupon from HR Department</p>
                </div><br class="m-hidden"/>
                <div id="date">
                    <input type="date" class="numValues" name="date" >
                </div><br class="m-hidden"/><br class="m-hidden"/>
            </div>
        </header>

        <section id="credentials">
            <p><span class="bold">SECTION 1 </span>(TO BE COMPLETED BY STAFF) </p>

             <div>
                {{--
                    <label>Staff ID</label>  
                    <input type="text" value="{{ auth()->user()->StaffID }}" name="StaffID" id="StaffID" readonly>{{ auth()->user()->StaffID }} 
                --}}
            </div>
            <br>
            <ul>
                <li>
                    <div class="form-group c1">
                        <label for="name">Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="maxWidth" name="name" id="name" readonly/>
                    </div>

                    <div class="form-group c2">
                        <label for="name">SAP No.</label>
                        <input type="text" class="numValues maxWidth" name="sapno" id="sapno" 
                          value="{{ auth()->user()->StaffID }}" readonly>
                    </div>

                    <div class="form-group c3">
                        <label for="cadre">Cadre/Designation</label>
                        <input type="text" class="maxWidth" name="cadre" id="cadre" 
                          value="{{ auth()->user()->cadre }}" readonly>
                    </div>

                    <div class="form-group c4">
                        <label for="department">Department</label>
                        <input type="text" value="{{ auth()->user()->department }}" class="maxWidth" 
                            name="department" id="department" readonly/>
                    </div>

                    <div class="form-group c5">
                        <label for="shift">Shift</label>
                        <input type="text" value="{{ auth()->user()->shift }}" class="maxWidth"
                            name="shift" id="shift" readonly/>
                    </div>

                </li>
            </ul>
        </section>

        <section  id="Leavetype">
            <p>Type of Leave <span class="italic">(Please select as applicable)</span></p>
            <ul>
                <li>
                    <select id="leavetype" name="leavetype" class="leavetype">
                        <option value="annual">Annual Leave</option>
                        <option value="maternity">Maternity</option>
                        <option value="casual">Casual Leave</option>
                        <option value="compassionate">Compassionate Leave</option>
                        <option value="department">Examination Leave</option>
                    </select>
                </li>
            </ul>
            <br>
            <p>If Casual Leave, please specify purpose</p>
            <input type="text" name="reason" id="reason">

            <div id="startleave"><br class="m-hidden"/>
                <div>
                    <label for="start">Leave Commences</label> <br class="m-hidden"/>
                    <input type="date" class="numValues" name="start" id="start">
                </div><br class="m-hidden"/>

                <div>
                    <label for="days">Leave Days</label> <br class="m-hidden"/>
                    <input type="number" class="numValues" name="days" id="days">
                </div><br class="m-hidden"/>

            </div><br class="m-hidden"/>


            <div id="contact">
                <p>
                    Contact Address
                    <span class="little"> (while on leave)</span>
                    <input type="text" class="maxWidth numValues" name="address" id="address">
                </p>
                <br/>
                <p>
                    Contact Phone No.
                    <input type="text" class="maxWidth numValues" name="phone" id="phone">
                </p>
                <br/>

                <p class=>Contact E-mail </p>
                <input type="email" value="{{ auth()->user()->email }}" class="maxWidth numValues" 
                    name="email" id="email" readonly/>
            </div>
        </section>
        <hr class="sectionend">

        <section id="declaration">
            <p><span class="bold">SECTION 2- DECLARATION</span></p>
            <div class="handover">
                <p>I will do / I have already done my handover note to</p>
                <input type="text" name="decl" id="decl">
            </div>
            <p>
                <span class="bold italic">
                    Reliever to acknowledge receipt of handover note and accept
					to cover for the staff proceeding on leave
                </span>
            </p>
            <br>
            <div class="dateover">
                <div class="form-group">
                    <p>
                        <span class="italic" style="margin-right: 30px">Applicant's Confirmation</span>
                    </p>
                    <select name="decl_sig" class="form-control" required>
                        <option value="approved">APPROVED</option>
                    </select>

                    <p class="ml-5 mt-md-0 mt-3">
                        Date
                        <input type="date" class="numValues ml-2 ml-md-0" name="decl_date" id="decl_date">
                    </p>
                </div>
            </div>

            <hr>

        </section>

        <section>
            <p class="italic bold main-footer">
                NOTE: Staff who have requested for any form of leave must receive an Approved Memo (Section A) 
                duly signed by Head of Human Resources, before proceeding on leave. On resumption of duty, 
                Section B of the attached should be duly completed by the staff and forwarded to the Human 
                Resources Department.
            </p>
        </section>
        <br>
        <br>

        <button type="submit" class="btn btn-success mb-4 ">SUBMIT</button>
        <a href="/home" class="btn btn-danger float-right mb-4">CANCEL</a>

    </form>
</main>
</div>

@endsection
