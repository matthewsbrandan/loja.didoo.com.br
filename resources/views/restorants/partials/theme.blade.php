<hr/>
<h6 class="heading-small text-muted mb-4">{{ __('Tema de Cores') }}</h6>
@php
  $theme = $restorant->getTheme();

  if(!$theme->bg_primary) $theme->bg_primary = '#6B238Eff';
  try{ $theme->bg_primary = (object)[
    'rgba' => $theme->bg_primary,
    'color' => substr($theme->bg_primary,0,-2),
    'opacity' => hexdec(substr($theme->bg_primary,-2)),
  ]; }catch(\Exception $e){ $hex = (object)[
    'rgba' => '#000000ff',
    'color' => "#000000",
    'opacity' => hexdec(33),
  ]; }

  if(!$theme->text_primary) $theme->text_primary = '#FFFFFFff';
  try{ $theme->text_primary = (object)[
    'rgba' => $theme->text_primary,
    'color' => substr($theme->text_primary,0,-2),
    'opacity' => hexdec(substr($theme->text_primary,-2)),
  ]; }catch(\Exception $e){ $hex = (object)[
    'rgba' => '#000000ff',
    'color' => "#000000",
    'opacity' => hexdec(33),
  ]; }

  if(!$theme->bg_footer) $theme->bg_footer = '#000000ff';
  try{ $theme->bg_footer = (object)[
    'rgba' => $theme->bg_footer,
    'color' => substr($theme->bg_footer,0,-2),
    'opacity' => hexdec(substr($theme->bg_footer,-2)),
  ]; }catch(\Exception $e){ $hex = (object)[
    'rgba' => '#000000ff',
    'color' => "#000000",
    'opacity' => hexdec(33),
  ]; }

  if(!$theme->text_footer) $theme->text_footer = '#ffffffff';
  try{ $theme->text_footer = (object)[
    'rgba' => $theme->text_footer,
    'color' => substr($theme->text_footer,0,-2),
    'opacity' => hexdec(substr($theme->text_footer,-2)),
  ]; }catch(\Exception $e){ $hex = (object)[
    'rgba' => '#000000ff',
    'color' => "#000000",
    'opacity' => hexdec(33),
  ]; }
@endphp
<div>
  <div class="form-group focused">
    <label class="form-control-label">Cor de fundo do Botão</label>
    <div class="d-flex flex-column" style="      
      gap: .4rem;      
      flex: 1;
      padding: 0 .4rem .4rem 0;
    ">
      <div class="d-flex justify-content-between align-items-center" style="
        margin-top: .6rem;
        gap: .4rem;
      ">
        <small class="text-muted">Cor:</small>
        <div>
          <input
            type="color"
            value="{{ $theme->bg_primary->color }}"
            id="theme-bg-primary-color"
            class="custom-input-color field-required"
            onchange="handleChangeRgba($(this).parent().parent().parent())"
            oninput="handleChangeRgba($(this).parent().parent().parent())"
            style="border: 1px solid var(--gray-500);"
            required
          />
          <span style="
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            border: 1px solid var(--gray-500);
            background: {{ $theme->bg_primary->rgba }};
          " class="mirror-input-color"></span>
        </div>
      </div>
      <div  class="d-flex justify-content-between align-items-center" style="
        gap: .4rem;
      ">
        <small class="text-dark-300">Transparência:</small>
        <input
          type="range"
          id="theme-bg-primary-opacity"
          class="field-required"
          min="0"
          max="255"
          step="5.1"
          value="{{ $theme->bg_primary->opacity }}"
          onchange="handleChangeRgba($(this).parent().parent())" oninput="handleChangeRgba($(this).parent().parent())">
      </div>
      <input type="hidden" name="theme_bg_primary" value="{{ $theme->bg_primary->rgba }}" required>
    </div>
  </div>
  <div class="form-group focused">
    <label class="form-control-label">Cor do texto do Botão</label>
    <div class="d-flex flex-column" style="      
      gap: .4rem;      
      flex: 1;
      padding: 0 .4rem .4rem 0;
    ">
      <div class="d-flex justify-content-between align-items-center" style="
        margin-top: .6rem;
        gap: .4rem;
      ">
        <small class="text-muted">Cor:</small>
        <div>
          <input
            type="color"
            value="{{ $theme->text_primary->color }}"
            id="theme-text-primary-color"
            class="custom-input-color field-required"
            onchange="handleChangeRgba($(this).parent().parent().parent())"
            oninput="handleChangeRgba($(this).parent().parent().parent())"
            style="border: 1px solid var(--gray-500);"
            required
          />
          <span style="
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            border: 1px solid var(--gray-500);
            background: {{ $theme->text_primary->rgba }};
          " class="mirror-input-color"></span>
        </div>
      </div>
      <div  class="d-flex justify-content-between align-items-center" style="
        gap: .4rem;
      ">
        <small class="text-dark-300">Transparência:</small>
        <input
          type="range"
          id="theme-text-primary-opacity"
          class="field-required"
          min="0"
          max="255"
          step="5.1"
          value="{{ $theme->text_primary->opacity }}"
          onchange="handleChangeRgba($(this).parent().parent())" oninput="handleChangeRgba($(this).parent().parent())">
      </div>
      <input type="hidden" name="theme_text_primary" value="{{ $theme->text_primary->rgba }}" required>
    </div>
  </div>
  <div class="form-group focused">
    <label class="form-control-label">Cor de fundo do Rodapé</label>
    <div class="d-flex flex-column" style="      
      gap: .4rem;      
      flex: 1;
      padding: 0 .4rem .4rem 0;
    ">
      <div class="d-flex justify-content-between align-items-center" style="
        margin-top: .6rem;
        gap: .4rem;
      ">
        <small class="text-muted">Cor:</small>
        <div>
          <input
            type="color"
            value="{{ $theme->bg_footer->color }}"
            id="theme-bg-footer-color"
            class="custom-input-color field-required"
            onchange="handleChangeRgba($(this).parent().parent().parent())"
            oninput="handleChangeRgba($(this).parent().parent().parent())"
            style="border: 1px solid var(--gray-500);"
            required
          />
          <span style="
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            border: 1px solid var(--gray-500);
            background: {{ $theme->bg_footer->rgba }};
          " class="mirror-input-color"></span>
        </div>
      </div>
      <div  class="d-flex justify-content-between align-items-center" style="
        gap: .4rem;
      ">
        <small class="text-dark-300">Transparência:</small>
        <input
          type="range"
          id="theme-bg-footer-opacity"
          class="field-required"
          min="0"
          max="255"
          step="5.1"
          value="{{ $theme->bg_footer->rgba }}"
          onchange="handleChangeRgba($(this).parent().parent())"
          oninput="handleChangeRgba($(this).parent().parent())"
        >
      </div>
      <input type="hidden" name="theme_bg_footer" value="{{ $theme->bg_footer->rgba }}" required>
    </div>
  </div>
  <div class="form-group focused">
    <label class="form-control-label">Cor do texto do Rodapé</label>
    <div class="d-flex flex-column" style="      
      gap: .4rem;      
      flex: 1;
      padding: 0 .4rem .4rem 0;
    ">
      <div class="d-flex justify-content-between align-items-center" style="
        margin-top: .6rem;
        gap: .4rem;
      ">
        <small class="text-muted">Cor:</small>
        <div>
          <input
            type="color"
            value="{{ $theme->text_footer->color }}"
            id="theme-text-footer-color"
            class="custom-input-color field-required"
            onchange="handleChangeRgba($(this).parent().parent().parent())"
            oninput="handleChangeRgba($(this).parent().parent().parent())"
            style="border: 1px solid var(--gray-500);"
            required
          />
          <span style="
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            border: 1px solid var(--gray-500);
            background: {{ $theme->text_footer->rgba }};
          " class="mirror-input-color"></span>
        </div>
      </div>
      <div  class="d-flex justify-content-between align-items-center" style="
        gap: .4rem;
      ">
        <small class="text-dark-300">Transparência:</small>
        <input
          type="range"
          id="theme-text-footer-opacity"
          class="field-required"
          min="0"
          max="255"
          step="5.1"
          value="{{ $theme->text_footer->opacity }}"
          onchange="handleChangeRgba($(this).parent().parent())" oninput="handleChangeRgba($(this).parent().parent())"
        />
      </div>
      <input
        type="hidden"
        name="theme_text_footer"
        value="{{ $theme->text_footer->rgba }}"
        required
      />
    </div>
  </div>
  <script>
    // BEGIN:: HANDLE RGBA
    function handleClearRgba(el){
      let container = el.parent();
      let target = el.next().children('input[type=hidden]');
      let alpha = target.prev().children('input[type=range]');
      let color = alpha.parent().prev().children('div').children('input[type=color]');
      if(el.is(':checked')){
        container.removeClass('opacity-7');
        alpha.attr('disabled', false);
        color.attr('disabled', false);
      }else{
        container.addClass('opacity-7');
        target.val(null);
        alpha.attr('disabled', true)
        color.attr('disabled', true)
      }
    }
    function handleChangeRgba(elem){
      let color = elem.find('input[type=color]').val() ?? null;
      let opacity = elem.find('input[type=range]').val() ?? null;
      let hidden = elem.find('input[type=hidden]') ?? null;
      let mirror = elem.find('.mirror-input-color') ?? null;
      if(color && opacity && hidden && mirror){
        let op = parseInt(opacity).toString(16);
        let hex = color + op.padStart(2,'0');
        mirror.css('background',hex);
        hidden.val(hex);
      }
    }
    // END:: HANDLE RGBA
  </script>
</div>