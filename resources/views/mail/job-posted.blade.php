<h2>
    {{ $job->title }}
</h2>
<div>
    <p>
        [Laracast - 30 days to Learn Laravel - https://laracasts.com/series/30-days-to-learn-laravel-11]
    </p>
    <p>
        Congratulations! Your posted job is now live at our website.
    </p>
    <p>
        <a href="{{ url('/jobs/' . $job->id) }}">View Job</a>
    </p>
</div>