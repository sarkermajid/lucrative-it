<ul class="tabbable faq-tabbable">
    <li class="@php echo in_array(Request::segment(1),array('myprofile','myprofile-edit'))?'active':'' @endphp"><a href="{{ url('myprofile') }}">Student Informatiom</a></li>
    <li class="@php echo in_array(Request::segment(1),array('contact-info','contact-info-edit'))?'active':'' @endphp"><a href="{{ url('contact-info') }}">Contact Informatiom</a></li>
    <li class="@php echo in_array(Request::segment(1),array('educational-info','educational-info-edit'))?'active':'' @endphp"><a href="{{ url('educational-info') }}">Educational Information</a></li>
    <li class="@php echo in_array(Request::segment(1),array('payments','payment-add'))?'active':'' @endphp"><a href="{{ url('payments') }}">Payments</a></li>
    <li class="@php echo in_array(Request::segment(1),array('payments','payment-add'))?'active':'' @endphp"><a href="{{ url('resume-view') }}">View Resume</a></li>
    <li class="@php echo in_array(Request::segment(1),array('resume-view-step1'))?'active':'' @endphp"><a href="{{ url('resume-view-step1') }}">Edit Resume</a></li>
</ul>