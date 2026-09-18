<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@if (\App\Support\Site::indexable())
    <url><loc>{{ \App\Support\Site::url() }}</loc></url>
    @foreach ($pages as $page)
    <url><loc>{{ \App\Support\Site::url($page['path']) }}</loc></url>
    @endforeach
@endif
</urlset>
