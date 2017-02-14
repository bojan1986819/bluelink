<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
    .tg td{font-family:Arial, sans-serif;font-size:10px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
    .tg .tg-yw4l{vertical-align:top}
    .cutoff-warning {
        color: red;!important;
        font-weight: bold;
    }
</style>
<table class="tg">
    <col width="250">
    <col width="150">
    <col width="300">
    <tr>
        <th class="tg-yw4l">Pay Group Name</th>
        <th class="tg-yw4l">Cut-off Date</th>
        <th class="tg-yw4l">Warning</th>
    </tr>
    @foreach($cutoffs as $cutoff)
        <article class="cutoffrows">
            <tr>
                <td>{{ $cutoff->paygroup }}</td>
                <td>{{ $cutoff->date }}</td>
                @if($cutoff->diffdate >2)
                    <td class="cutoff-warning">Has to be updated in {{ $cutoff->diffdate-1 }} days!</td>
                @elseif($cutoff->diffdate ==1)
                    <td class="cutoff-warning" style="background-color: red; color: yellow;">UPDATE CUTOFF TODAY!</td>
                @elseif($cutoff->diffdate == 2)
                    <td class="cutoff-warning">Has to be updated tomorrow!</td>
                @elseif($cutoff->diffdate < 1)
                    <td class="cutoff-warning" style="background-color: red; color: yellow;">CUTOFF IS IN THE PAST!</td>
                @endif
            </tr>
        </article>
    @endforeach
</table>