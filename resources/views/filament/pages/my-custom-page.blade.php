@push('styles')
<style>
/* =============================================
   Custom Notes Section — Rich Editor Styles
   Parent: .custom-notes-section
   ============================================= */

/* ---------- Headings ---------- */
.custom-notes-section h1,
.custom-notes-section h2,
.custom-notes-section h3,
.custom-notes-section h4,
.custom-notes-section h5,
.custom-notes-section h6 {

    font-weight: 700;
    line-height: 1.3;
    margin-top: 1.8em;
    margin-bottom: 0.6em;
    color: #1a202c;
}

.custom-notes-section h1 {
    font-size: 2.2rem;
    border-bottom: 3px solid #3b82f6;
    padding-bottom: 0.3em;
}
.custom-notes-section h2 {
    font-size: 1.75rem;
    border-bottom: 1.5px solid #e2e8f0;
    padding-bottom: 0.25em;
}
.custom-notes-section h3 { font-size: 1.4rem; color: #2d3748; }
.custom-notes-section h4 { font-size: 1.15rem; color: #4a5568; }
.custom-notes-section h5 {
    font-size: 1rem;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}
.custom-notes-section h6 {
    font-size: 0.875rem;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* ---------- Paragraph ---------- */
.custom-notes-section p {
    font-size: 1rem;
    line-height: 1.8;
    color: #4a5568;
    margin-bottom: 1.2em;
}

/* ---------- Lists ---------- */
.custom-notes-section ul,
.custom-notes-section ol {
    margin: 0.8em 0 1.2em 1.5em;
    padding: 0;
}

/* Unordered — custom bullet */
.custom-notes-section ul { list-style: none; }
.custom-notes-section ul li {
    position: relative;
    padding-left: 1.4em;
    margin-bottom: 0.5em;
    color: #4a5568;
    line-height: 1.7;
}
.custom-notes-section ul li::before {
    content: '▸';
    position: absolute;
    left: 0;
    color: #3b82f6;
    font-size: 0.85em;
    top: 0.15em;
}

/* Ordered */
.custom-notes-section ol { list-style: decimal; }
.custom-notes-section ol li {
    margin-bottom: 0.5em;
    color: #4a5568;
    line-height: 1.7;
    padding-left: 0.3em;
}

/* Nested lists */
.custom-notes-section ul ul,
.custom-notes-section ol ol,
.custom-notes-section ul ol,
.custom-notes-section ol ul {
    margin: 0.4em 0 0.4em 1.2em;
}

/* ---------- Inline elements ---------- */
.custom-notes-section strong,
.custom-notes-section b { font-weight: 700; color: #1a202c; }

.custom-notes-section em,
.custom-notes-section i { font-style: italic; }

.custom-notes-section u {
    text-decoration: underline;
    text-underline-offset: 3px;
}

.custom-notes-section s,
.custom-notes-section del {
    text-decoration: line-through;
    color: #a0aec0;
}

.custom-notes-section mark {
    background: #fef08a;
    padding: 0 0.2em;
    border-radius: 2px;
}

.custom-notes-section a {
    color: #3b82f6;
    text-decoration: underline;
    text-underline-offset: 2px;
    transition: color 0.2s;
}
.custom-notes-section a:hover { color: #1d4ed8; }

/* ---------- Blockquote ---------- */
.custom-notes-section blockquote {
    border-left: 4px solid #3b82f6;
    margin: 1.5em 0;
    padding: 0.8em 1.2em;
    background: #eff6ff;
    border-radius: 0 6px 6px 0;
    color: #374151;
    font-style: italic;
}

/* ---------- Code ---------- */
.custom-notes-section code {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 0.1em 0.4em;
    font-family: 'Courier New', monospace;
    font-size: 0.875em;
    color: #e11d48;
}

.custom-notes-section pre {
    background: #1e293b;
    border-radius: 8px;
    padding: 1.2em 1.5em;
    overflow-x: auto;
    margin: 1.2em 0;
}
.custom-notes-section pre code {
    background: none;
    border: none;
    color: #e2e8f0;
    font-size: 0.9em;
    padding: 0;
}

/* ---------- Table ---------- */
.custom-notes-section table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5em 0;
    font-size: 0.95rem;
}
.custom-notes-section th {
    background: #1e293b;
    color: #f8fafc;
    text-align: left;
    padding: 0.65em 1em;
    font-weight: 600;
    letter-spacing: 0.04em;
}
.custom-notes-section td {
    padding: 0.6em 1em;
    border-bottom: 1px solid #e2e8f0;
    color: #4a5568;
}
.custom-notes-section tr:last-child td { border-bottom: none; }
.custom-notes-section tr:nth-child(even) td { background: #f8fafc; }

/* ---------- HR ---------- */
.custom-notes-section hr {
    border: none;
    border-top: 2px solid #e2e8f0;
    margin: 2em 0;
}

/* ---------- Image ---------- */
.custom-notes-section img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1em 0;
    display: block;
}

/* ---------- Utility ---------- */
.custom-notes-section > *:first-child { margin-top: 0; }
</style>
@endpush
<x-filament-panels::page>
    @if($this->member?->notes)
       <x-filament::section class="mb-6">
    <x-slot name="heading">
        📝 Notes
    </x-slot>

    <div class="prose max-w-none bg-red-50 custom-notes-section ">
        {!! $this->member->notes !!}
    </div>
</x-filament::section>
    @endif


    <form wire:submit="save">

        {{ $this->form }}

        <div class="mt-6 flex items-center gap-4">
            <x-filament::button type="submit" size="lg" >
                Save Profile
            </x-filament::button>

            <x-filament::button
                type="button"
                color="gray"
                size="lg"
                wire:click="$refresh"
            >
                Reset
            </x-filament::button>
        </div>

    </form>

    <x-filament-actions::modals />

</x-filament-panels::page>

