@extends('adminlayout.app')
@section('title', 'Admin Portel ')
@section('adminContent')

    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h2>Dashboard Overview</h2>
                <p>Welcome back, Super Admin — here's what's happening at SRU today.</p>
            </div>
            <div class="page-date">
                <i class="fas fa-calendar-days"></i>
                <span id="currentDate">Monday, April 13, 2026</span>
            </div>
        </div>

        <!-- ── STAT CARDS ── -->
        <div class="stats-grid">

            <div class="stat-card card-blue">
                <div class="stat-top">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <span class="stat-badge" style="--badge-bg:var(--blue-50);--badge-clr:var(--blue-600);">+4.2%</span>
                </div>
                <div class="stat-value">12,480</div>
                <div class="stat-label">Total Students</div>
                <div class="stat-footer">
                    <i class="fas fa-arrow-trend-up" style="color:var(--success);"></i>
                    <span>524 new this semester</span>
                </div>
            </div>

            <div class="stat-card card-green">
                <div class="stat-top">
                    <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="stat-badge" style="--badge-bg:var(--success-lt);--badge-clr:var(--success);">+1.8%</span>
                </div>
                <div class="stat-value">648</div>
                <div class="stat-label">Faculty Members</div>
                <div class="stat-footer">
                    <i class="fas fa-arrow-trend-up" style="color:var(--success);"></i>
                    <span>12 new this year</span>
                </div>
            </div>

            <div class="stat-card card-amber">
                <div class="stat-top">
                    <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                    <span class="stat-badge" style="--badge-bg:var(--accent-lt);--badge-clr:#b45309;">+6
                        new</span>
                </div>
                <div class="stat-value">186</div>
                <div class="stat-label">Active Courses</div>
                <div class="stat-footer">
                    <i class="fas fa-circle-info" style="color:var(--accent);"></i>
                    <span>Across 22 departments</span>
                </div>
            </div>

            <div class="stat-card card-purple">
                <div class="stat-top">
                    <div class="stat-icon"><i class="fas fa-sitemap"></i></div>
                    <span class="stat-badge" style="--badge-bg:var(--purple-lt);--badge-clr:var(--purple);">Stable</span>
                </div>
                <div class="stat-value">22</div>
                <div class="stat-label">Departments</div>
                <div class="stat-footer">
                    <i class="fas fa-building-columns" style="color:var(--purple);"></i>
                    <span>3 faculties &amp; 7 schools</span>
                </div>
            </div>

        </div><!-- .stats-grid -->


        <!-- ── SECONDARY ROW: Notices + Events ── -->
        <div class="secondary-row">

            <!-- Notices -->
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <i class="fas fa-circle-info"></i>
                        Recent Notices
                    </div>
                    <button class="panel-action">Manage</button>
                </div>
                <div class="notice-list">

                    <div class="notice-item">
                        <div class="notice-dot-wrap">
                            <div class="notice-dot red"></div>
                        </div>
                        <div class="notice-content">
                            <div class="notice-title">Mid Semester Examination Schedule Released</div>
                            <div class="notice-meta">
                                <span><i class="far fa-calendar" style="margin-right:3px;"></i>Apr 12,
                                    2026</span>
                                <span><i class="fas fa-tag" style="margin-right:3px;"></i>Examination</span>
                            </div>
                        </div>
                    </div>

                    <div class="notice-item">
                        <div class="notice-dot-wrap">
                            <div class="notice-dot amber"></div>
                        </div>
                        <div class="notice-content">
                            <div class="notice-title">Last Date for Scholarship Applications: Apr 30</div>
                            <div class="notice-meta">
                                <span><i class="far fa-calendar" style="margin-right:3px;"></i>Apr 10,
                                    2026</span>
                                <span><i class="fas fa-tag" style="margin-right:3px;"></i>Finance</span>
                            </div>
                        </div>
                    </div>

                    <div class="notice-item">
                        <div class="notice-dot-wrap">
                            <div class="notice-dot"></div>
                        </div>
                        <div class="notice-content">
                            <div class="notice-title">Faculty Development Program — May 5–9</div>
                            <div class="notice-meta">
                                <span><i class="far fa-calendar" style="margin-right:3px;"></i>Apr 8,
                                    2026</span>
                                <span><i class="fas fa-tag" style="margin-right:3px;"></i>Faculty</span>
                            </div>
                        </div>
                    </div>

                    <div class="notice-item">
                        <div class="notice-dot-wrap">
                            <div class="notice-dot green"></div>
                        </div>
                        <div class="notice-content">
                            <div class="notice-title">Campus Placement Drive — Infosys &amp; TCS</div>
                            <div class="notice-meta">
                                <span><i class="far fa-calendar" style="margin-right:3px;"></i>Apr 5,
                                    2026</span>
                                <span><i class="fas fa-tag" style="margin-right:3px;"></i>Placement</span>
                            </div>
                        </div>
                    </div>

                    <div class="notice-item">
                        <div class="notice-dot-wrap">
                            <div class="notice-dot amber"></div>
                        </div>
                        <div class="notice-content">
                            <div class="notice-title">University Annual Day — April 28, 2026</div>
                            <div class="notice-meta">
                                <span><i class="far fa-calendar" style="margin-right:3px;"></i>Apr 1,
                                    2026</span>
                                <span><i class="fas fa-tag" style="margin-right:3px;"></i>Events</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- notices panel -->

            <!-- Upcoming Events -->
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <i class="fas fa-calendar-star"></i>
                        Upcoming Events
                    </div>
                    <button class="panel-action">Full Calendar</button>
                </div>
                <div class="event-list">

                    <div class="event-item">
                        <div class="event-date-box">
                            <div class="e-day">15</div>
                            <div class="e-mon">Apr</div>
                        </div>
                        <div class="event-body">
                            <div class="e-title">Alumni Meet 2026</div>
                            <div class="e-info">
                                <span><i class="far fa-clock" style="margin-right:3px;"></i>10:00 AM</span>
                                <span><i class="fas fa-location-dot" style="margin-right:3px;"></i>Main
                                    Auditorium</span>
                            </div>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="event-date-box">
                            <div class="e-day">18</div>
                            <div class="e-mon">Apr</div>
                        </div>
                        <div class="event-body">
                            <div class="e-title">Science &amp; Tech Symposium</div>
                            <div class="e-info">
                                <span><i class="far fa-clock" style="margin-right:3px;"></i>9:30 AM</span>
                                <span><i class="fas fa-location-dot" style="margin-right:3px;"></i>Conference
                                    Hall B</span>
                            </div>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="event-date-box">
                            <div class="e-day">22</div>
                            <div class="e-mon">Apr</div>
                        </div>
                        <div class="event-body">
                            <div class="e-title">Mid-Sem Exam Begins</div>
                            <div class="e-info">
                                <span><i class="far fa-clock" style="margin-right:3px;"></i>All Day</span>
                                <span><i class="fas fa-location-dot" style="margin-right:3px;"></i>All
                                    Blocks</span>
                            </div>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="event-date-box">
                            <div class="e-day">28</div>
                            <div class="e-mon">Apr</div>
                        </div>
                        <div class="event-body">
                            <div class="e-title">University Annual Day</div>
                            <div class="e-info">
                                <span><i class="far fa-clock" style="margin-right:3px;"></i>4:00 PM</span>
                                <span><i class="fas fa-location-dot" style="margin-right:3px;"></i>Open
                                    Amphitheatre</span>
                            </div>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="event-date-box">
                            <div class="e-day">05</div>
                            <div class="e-mon">May</div>
                        </div>
                        <div class="event-body">
                            <div class="e-title">Faculty Dev. Program</div>
                            <div class="e-info">
                                <span><i class="far fa-clock" style="margin-right:3px;"></i>9:00 AM – 5
                                    days</span>
                                <span><i class="fas fa-location-dot" style="margin-right:3px;"></i>Seminar
                                    Room 3</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- events panel -->

        </div><!-- .secondary-row -->

    </div>

@endsection
