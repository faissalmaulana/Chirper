@props(['chirp'])

<div class="card bg-base-100">
    <div class="card-body pb-4">
        <div class="flex gap-3">

            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="https://avatars.laravel.cloud/{{ urlencode($chirp->user->email ?? 'anonymous@example.com') }}"
                         alt="avatar" class="rounded-full" />
                </div>
            </div>

            <div class="flex-1 min-w-0">

                <div class="flex items-center justify-between">
                    <div class="flex flex-wrap items-center gap-1 text-sm">
                        <span class="font-semibold">
                            {{ $chirp->user->name ?? 'Anonymous' }}
                        </span>

                        <span class="text-base-content/60">·</span>

                        <span class="text-base-content/60">
                            {{ $chirp->created_at->diffForHumans() }}
                        </span>

                        @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                            <span class="text-base-content/60">·</span>
                            <span class="italic text-base-content/60">
                                edited
                            </span>
                        @endif
                    </div>

                    @can('update', $chirp)
                        <div class="flex items-center gap-1">
                            <a href="/chirps/{{ $chirp->id }}/edit"
                               class="btn btn-ghost btn-xs">
                                Edit
                            </a>
                            <form method="POST" action="/chirps/{{ $chirp->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this chirp?')"
                                    class="btn btn-ghost btn-xs text-error">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <p class="mt-1 whitespace-pre-line text-sm">
                    {{ $chirp->message }}
                </p>

                <p class="mt-3 text-sm text-base-content/60">
                    {{ $chirp->comments->count() }} comments
                </p>

            </div>
        </div>
    </div>
</div>
