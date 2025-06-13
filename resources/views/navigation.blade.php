@php
    $role = session('user.role') ?? 'Platinum';

    // Sidebar background color and link default color based on role
    switch ($role) {
        case 'CRMP':
            $sidebarColor = '#28a745'; // Green
            $linkColor = '#1e7e34';
            $hoverColor = '#155d27';
            break;
        case 'Mentor':
            $sidebarColor = '#ffc107'; // Yellow
            $linkColor = '#d39e00';
            $hoverColor = '#b38f00';
            break;
        case 'Staff':
            $sidebarColor = '#6f42c1'; // Purple
            $linkColor = '#5a32a3';
            $hoverColor = '#45257c';
            break;
        default: // Platinum or fallback
            $sidebarColor = '#007bff'; // Blue
            $linkColor = '#0056b3';
            $hoverColor = '#003d80';
            break;
    }
@endphp

@php
    $role = session('user.role') ?? 'Platinum';

    // Sidebar background color and link default color based on role
    switch ($role) {
        case 'CRMP':
            $sidebarColor = '#28a745'; // Green
            $linkColor = '#1e7e34';
            $hoverColor = '#155d27';
            break;
        case 'Mentor':
            $sidebarColor = '#ffc107'; // Yellow
            $linkColor = '#d39e00';
            $hoverColor = '#b38f00';
            break;
        case 'Staff':
            $sidebarColor = '#6f42c1'; // Purple
            $linkColor = '#5a32a3';
            $hoverColor = '#45257c';
            break;
        default: // Platinum or fallback
            $sidebarColor = '#007bff'; // Blue
            $linkColor = '#0056b3';
            $hoverColor = '#003d80';
            break;
    }
@endphp

<nav style="
    background: {{ $sidebarColor }};
    background: {{ $sidebarColor }};
    width: 220px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    justify-content: center;
    box-sizing: border-box;
">
    <ul style="
        list-style:none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 15px;
        justify-content: center;
    ">
        @php

            $navItems = [
                'Dashboard' => '/welcome',
                'Profile' => '/profile',
                'Expert Domain' =>  route('expertDomain.redirect'),
                'Publication' => '/publication.php',
                'Weekly Progress' => '/report.php',
                'Thesis Report' => '/report.php',
                'Logout' => '/logout.php'
            ];
        @endphp

        @foreach($navItems as $label => $link)
            <li>
                <a href="{{ $link }}" style="
                    display: block;
                    padding: 12px 20px;
                    background: {{ $linkColor }};
                    color: #fff;
                    text-decoration: none;
                    border-radius: 6px;
                    text-align: center;
                    font-weight: bold;
                    transition: background 0.3s;
                "
                onmouseover="this.style.background='{{ $hoverColor }}'"
                onmouseout="this.style.background='{{ $linkColor }}'">
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
