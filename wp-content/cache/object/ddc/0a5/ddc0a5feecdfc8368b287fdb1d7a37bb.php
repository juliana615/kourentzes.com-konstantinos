6D`c<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:23;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2022-02-05 22:25:53";s:13:"post_date_gmt";s:19:"2022-02-05 22:25:53";s:12:"post_content";s:25324:"<blockquote>
<pre class="prettyprint lang-js prettyprinted"><span class="kwd">function</span><span class="pln"> signatureCapture</span><span class="pun">()</span> <span class="pun">{</span>
  <span class="kwd">var</span><span class="pln"> canvas </span><span class="pun">=</span><span class="pln"> document</span><span class="pun">.</span><span class="pln">getElementById</span><span class="pun">(</span><span class="str">"newSignature"</span><span class="pun">);</span>
  <span class="kwd">var</span><span class="pln"> context </span><span class="pun">=</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">getContext</span><span class="pun">(</span><span class="str">"2d"</span><span class="pun">);</span><span class="pln">
  canvas</span><span class="pun">.</span><span class="pln">width </span><span class="pun">=</span> <span class="lit">276</span><span class="pun">;</span><span class="pln">
  canvas</span><span class="pun">.</span><span class="pln">height </span><span class="pun">=</span> <span class="lit">180</span><span class="pun">;</span><span class="pln">
  context</span><span class="pun">.</span><span class="pln">fillStyle </span><span class="pun">=</span> <span class="str">"#fff"</span><span class="pun">;</span><span class="pln">
  context</span><span class="pun">.</span><span class="pln">strokeStyle </span><span class="pun">=</span> <span class="str">"#444"</span><span class="pun">;</span><span class="pln">
  context</span><span class="pun">.</span><span class="pln">lineWidth </span><span class="pun">=</span> <span class="lit">1.5</span><span class="pun">;</span><span class="pln">
  context</span><span class="pun">.</span><span class="pln">lineCap </span><span class="pun">=</span> <span class="str">"round"</span><span class="pun">;</span><span class="pln">
  context</span><span class="pun">.</span><span class="pln">fillRect</span><span class="pun">(</span><span class="lit">0</span><span class="pun">,</span> <span class="lit">0</span><span class="pun">,</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">width</span><span class="pun">,</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">height</span><span class="pun">);</span>
  <span class="kwd">var</span><span class="pln"> disableSave </span><span class="pun">=</span> <span class="kwd">true</span><span class="pun">;</span>
  <span class="kwd">var</span><span class="pln"> pixels </span><span class="pun">=</span> <span class="pun">[];</span>
  <span class="kwd">var</span><span class="pln"> cpixels </span><span class="pun">=</span> <span class="pun">[];</span>
  <span class="kwd">var</span><span class="pln"> xyLast </span><span class="pun">=</span> <span class="pun">{};</span>
  <span class="kwd">var</span><span class="pln"> xyAddLast </span><span class="pun">=</span> <span class="pun">{};</span>
  <span class="kwd">var</span><span class="pln"> calculate </span><span class="pun">=</span> <span class="kwd">false</span><span class="pun">;</span>
  <span class="pun">{</span>   <span class="com">//functions</span>
    <span class="kwd">function</span><span class="pln"> remove_event_listeners</span><span class="pun">()</span> <span class="pun">{</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">removeEventListener</span><span class="pun">(</span><span class="str">'mousemove'</span><span class="pun">,</span><span class="pln"> on_mousemove</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">removeEventListener</span><span class="pun">(</span><span class="str">'mouseup'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">removeEventListener</span><span class="pun">(</span><span class="str">'touchmove'</span><span class="pun">,</span><span class="pln"> on_mousemove</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">removeEventListener</span><span class="pun">(</span><span class="str">'touchend'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">

      document</span><span class="pun">.</span><span class="pln">body</span><span class="pun">.</span><span class="pln">removeEventListener</span><span class="pun">(</span><span class="str">'mouseup'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      document</span><span class="pun">.</span><span class="pln">body</span><span class="pun">.</span><span class="pln">removeEventListener</span><span class="pun">(</span><span class="str">'touchend'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span>
    <span class="pun">}</span>

    <span class="kwd">function</span><span class="pln"> get_coords</span><span class="pun">(</span><span class="pln">e</span><span class="pun">)</span> <span class="pun">{</span>
      <span class="kwd">var</span><span class="pln"> x</span><span class="pun">,</span><span class="pln"> y</span><span class="pun">;</span>

      <span class="kwd">if</span> <span class="pun">(</span><span class="pln">e</span><span class="pun">.</span><span class="pln">changedTouches </span><span class="pun">&amp;&amp;</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">changedTouches</span><span class="pun">[</span><span class="lit">0</span><span class="pun">])</span> <span class="pun">{</span>
        <span class="kwd">var</span><span class="pln"> offsety </span><span class="pun">=</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">offsetTop </span><span class="pun">||</span> <span class="lit">0</span><span class="pun">;</span>
        <span class="kwd">var</span><span class="pln"> offsetx </span><span class="pun">=</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">offsetLeft </span><span class="pun">||</span> <span class="lit">0</span><span class="pun">;</span><span class="pln">

        x </span><span class="pun">=</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">changedTouches</span><span class="pun">[</span><span class="lit">0</span><span class="pun">].</span><span class="pln">pageX </span><span class="pun">-</span><span class="pln"> offsetx</span><span class="pun">;</span><span class="pln">
        y </span><span class="pun">=</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">changedTouches</span><span class="pun">[</span><span class="lit">0</span><span class="pun">].</span><span class="pln">pageY </span><span class="pun">-</span><span class="pln"> offsety</span><span class="pun">;</span>
      <span class="pun">}</span> <span class="kwd">else</span> <span class="kwd">if</span> <span class="pun">(</span><span class="pln">e</span><span class="pun">.</span><span class="pln">layerX </span><span class="pun">||</span> <span class="lit">0</span> <span class="pun">==</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">layerX</span><span class="pun">)</span> <span class="pun">{</span><span class="pln">
        x </span><span class="pun">=</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">layerX</span><span class="pun">;</span><span class="pln">
        y </span><span class="pun">=</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">layerY</span><span class="pun">;</span>
      <span class="pun">}</span> <span class="kwd">else</span> <span class="kwd">if</span> <span class="pun">(</span><span class="pln">e</span><span class="pun">.</span><span class="pln">offsetX </span><span class="pun">||</span> <span class="lit">0</span> <span class="pun">==</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">offsetX</span><span class="pun">)</span> <span class="pun">{</span><span class="pln">
        x </span><span class="pun">=</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">offsetX</span><span class="pun">;</span><span class="pln">
        y </span><span class="pun">=</span><span class="pln"> e</span><span class="pun">.</span><span class="pln">offsetY</span><span class="pun">;</span>
      <span class="pun">}</span>

      <span class="kwd">return</span> <span class="pun">{</span><span class="pln">
        x </span><span class="pun">:</span><span class="pln"> x</span><span class="pun">,</span><span class="pln"> y </span><span class="pun">:</span><span class="pln"> y
      </span><span class="pun">};</span>
    <span class="pun">};</span>

    <span class="kwd">function</span><span class="pln"> on_mousedown</span><span class="pun">(</span><span class="pln">e</span><span class="pun">)</span> <span class="pun">{</span><span class="pln">
      e</span><span class="pun">.</span><span class="pln">preventDefault</span><span class="pun">();</span><span class="pln">
      e</span><span class="pun">.</span><span class="pln">stopPropagation</span><span class="pun">();</span><span class="pln">

      canvas</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'mouseup'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'mousemove'</span><span class="pun">,</span><span class="pln"> on_mousemove</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'touchend'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      canvas</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'touchmove'</span><span class="pun">,</span><span class="pln"> on_mousemove</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      document</span><span class="pun">.</span><span class="pln">body</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'mouseup'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
      document</span><span class="pun">.</span><span class="pln">body</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'touchend'</span><span class="pun">,</span><span class="pln"> on_mouseup</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">

      empty </span><span class="pun">=</span> <span class="kwd">false</span><span class="pun">;</span>
      <span class="kwd">var</span><span class="pln"> xy </span><span class="pun">=</span><span class="pln"> get_coords</span><span class="pun">(</span><span class="pln">e</span><span class="pun">);</span><span class="pln">
      context</span><span class="pun">.</span><span class="pln">beginPath</span><span class="pun">();</span><span class="pln">
      pixels</span><span class="pun">.</span><span class="pln">push</span><span class="pun">(</span><span class="str">'moveStart'</span><span class="pun">);</span><span class="pln">
      context</span><span class="pun">.</span><span class="pln">moveTo</span><span class="pun">(</span><span class="pln">xy</span><span class="pun">.</span><span class="pln">x</span><span class="pun">,</span><span class="pln"> xy</span><span class="pun">.</span><span class="pln">y</span><span class="pun">);</span><span class="pln">
      pixels</span><span class="pun">.</span><span class="pln">push</span><span class="pun">(</span><span class="pln">xy</span><span class="pun">.</span><span class="pln">x</span><span class="pun">,</span><span class="pln"> xy</span><span class="pun">.</span><span class="pln">y</span><span class="pun">);</span><span class="pln">
      xyLast </span><span class="pun">=</span><span class="pln"> xy</span><span class="pun">;</span>
    <span class="pun">};</span>

    <span class="kwd">function</span><span class="pln"> on_mousemove</span><span class="pun">(</span><span class="pln">e</span><span class="pun">,</span><span class="pln"> finish</span><span class="pun">)</span> <span class="pun">{</span><span class="pln">
      e</span><span class="pun">.</span><span class="pln">preventDefault</span><span class="pun">();</span><span class="pln">
      e</span><span class="pun">.</span><span class="pln">stopPropagation</span><span class="pun">();</span>

      <span class="kwd">var</span><span class="pln"> xy </span><span class="pun">=</span><span class="pln"> get_coords</span><span class="pun">(</span><span class="pln">e</span><span class="pun">);</span>
      <span class="kwd">var</span><span class="pln"> xyAdd </span><span class="pun">=</span> <span class="pun">{</span><span class="pln">
        x </span><span class="pun">:</span> <span class="pun">(</span><span class="pln">xyLast</span><span class="pun">.</span><span class="pln">x </span><span class="pun">+</span><span class="pln"> xy</span><span class="pun">.</span><span class="pln">x</span><span class="pun">)</span> <span class="pun">/</span> <span class="lit">2</span><span class="pun">,</span><span class="pln">
        y </span><span class="pun">:</span> <span class="pun">(</span><span class="pln">xyLast</span><span class="pun">.</span><span class="pln">y </span><span class="pun">+</span><span class="pln"> xy</span><span class="pun">.</span><span class="pln">y</span><span class="pun">)</span> <span class="pun">/</span> <span class="lit">2</span>
      <span class="pun">};</span>

      <span class="kwd">if</span> <span class="pun">(</span><span class="pln">calculate</span><span class="pun">)</span> <span class="pun">{</span>
        <span class="kwd">var</span><span class="pln"> xLast </span><span class="pun">=</span> <span class="pun">(</span><span class="pln">xyAddLast</span><span class="pun">.</span><span class="pln">x </span><span class="pun">+</span><span class="pln"> xyLast</span><span class="pun">.</span><span class="pln">x </span><span class="pun">+</span><span class="pln"> xyAdd</span><span class="pun">.</span><span class="pln">x</span><span class="pun">)</span> <span class="pun">/</span> <span class="lit">3</span><span class="pun">;</span>
        <span class="kwd">var</span><span class="pln"> yLast </span><span class="pun">=</span> <span class="pun">(</span><span class="pln">xyAddLast</span><span class="pun">.</span><span class="pln">y </span><span class="pun">+</span><span class="pln"> xyLast</span><span class="pun">.</span><span class="pln">y </span><span class="pun">+</span><span class="pln"> xyAdd</span><span class="pun">.</span><span class="pln">y</span><span class="pun">)</span> <span class="pun">/</span> <span class="lit">3</span><span class="pun">;</span><span class="pln">
        pixels</span><span class="pun">.</span><span class="pln">push</span><span class="pun">(</span><span class="pln">xLast</span><span class="pun">,</span><span class="pln"> yLast</span><span class="pun">);</span>
      <span class="pun">}</span> <span class="kwd">else</span> <span class="pun">{</span><span class="pln">
        calculate </span><span class="pun">=</span> <span class="kwd">true</span><span class="pun">;</span>
      <span class="pun">}</span><span class="pln">

      context</span><span class="pun">.</span><span class="pln">quadraticCurveTo</span><span class="pun">(</span><span class="pln">xyLast</span><span class="pun">.</span><span class="pln">x</span><span class="pun">,</span><span class="pln"> xyLast</span><span class="pun">.</span><span class="pln">y</span><span class="pun">,</span><span class="pln"> xyAdd</span><span class="pun">.</span><span class="pln">x</span><span class="pun">,</span><span class="pln"> xyAdd</span><span class="pun">.</span><span class="pln">y</span><span class="pun">);</span><span class="pln">
      pixels</span><span class="pun">.</span><span class="pln">push</span><span class="pun">(</span><span class="pln">xyAdd</span><span class="pun">.</span><span class="pln">x</span><span class="pun">,</span><span class="pln"> xyAdd</span><span class="pun">.</span><span class="pln">y</span><span class="pun">);</span><span class="pln">
      context</span><span class="pun">.</span><span class="pln">stroke</span><span class="pun">();</span><span class="pln">
      context</span><span class="pun">.</span><span class="pln">beginPath</span><span class="pun">();</span><span class="pln">
      context</span><span class="pun">.</span><span class="pln">moveTo</span><span class="pun">(</span><span class="pln">xyAdd</span><span class="pun">.</span><span class="pln">x</span><span class="pun">,</span><span class="pln"> xyAdd</span><span class="pun">.</span><span class="pln">y</span><span class="pun">);</span><span class="pln">
      xyAddLast </span><span class="pun">=</span><span class="pln"> xyAdd</span><span class="pun">;</span><span class="pln">
      xyLast </span><span class="pun">=</span><span class="pln"> xy</span><span class="pun">;</span>

    <span class="pun">};</span>

    <span class="kwd">function</span><span class="pln"> on_mouseup</span><span class="pun">(</span><span class="pln">e</span><span class="pun">)</span> <span class="pun">{</span><span class="pln">
      remove_event_listeners</span><span class="pun">();</span><span class="pln">
      disableSave </span><span class="pun">=</span> <span class="kwd">false</span><span class="pun">;</span><span class="pln">
      context</span><span class="pun">.</span><span class="pln">stroke</span><span class="pun">();</span><span class="pln">
      pixels</span><span class="pun">.</span><span class="pln">push</span><span class="pun">(</span><span class="str">'e'</span><span class="pun">);</span><span class="pln">
      calculate </span><span class="pun">=</span> <span class="kwd">false</span><span class="pun">;</span>
    <span class="pun">};</span>
  <span class="pun">}</span><span class="pln">
  canvas</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'touchstart'</span><span class="pun">,</span><span class="pln"> on_mousedown</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span><span class="pln">
  canvas</span><span class="pun">.</span><span class="pln">addEventListener</span><span class="pun">(</span><span class="str">'mousedown'</span><span class="pun">,</span><span class="pln"> on_mousedown</span><span class="pun">,</span> <span class="kwd">false</span><span class="pun">);</span>
<span class="pun">}</span>

<span class="kwd">function</span><span class="pln"> signatureSave</span><span class="pun">()</span> <span class="pun">{</span>
  <span class="kwd">var</span><span class="pln"> canvas </span><span class="pun">=</span><span class="pln"> document</span><span class="pun">.</span><span class="pln">getElementById</span><span class="pun">(</span><span class="str">"newSignature"</span><span class="pun">);</span><span class="com">// save canvas image as data url (png format by default)</span>
  <span class="kwd">var</span><span class="pln"> dataURL </span><span class="pun">=</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">toDataURL</span><span class="pun">(</span><span class="str">"image/png"</span><span class="pun">);</span><span class="pln">
  document</span><span class="pun">.</span><span class="pln">getElementById</span><span class="pun">(</span><span class="str">"saveSignature"</span><span class="pun">).</span><span class="pln">src </span><span class="pun">=</span><span class="pln"> dataURL</span><span class="pun">;</span>
<span class="pun">};</span>

<span class="kwd">function</span><span class="pln"> signatureClear</span><span class="pun">()</span> <span class="pun">{</span>
  <span class="kwd">var</span><span class="pln"> canvas </span><span class="pun">=</span><span class="pln"> document</span><span class="pun">.</span><span class="pln">getElementById</span><span class="pun">(</span><span class="str">"newSignature"</span><span class="pun">);</span>
  <span class="kwd">var</span><span class="pln"> context </span><span class="pun">=</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">getContext</span><span class="pun">(</span><span class="str">"2d"</span><span class="pun">);</span><span class="pln">
  context</span><span class="pun">.</span><span class="pln">clearRect</span><span class="pun">(</span><span class="lit">0</span><span class="pun">,</span> <span class="lit">0</span><span class="pun">,</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">width</span><span class="pun">,</span><span class="pln"> canvas</span><span class="pun">.</span><span class="pln">height</span><span class="pun">);</span>
<span class="pun">}</span></pre>
</blockquote>

<blockquote>
<pre class="prettyprint lang-html prettyprinted"><span class="dec">&lt;!DOCTYPE html&gt;</span>
<span class="tag">&lt;html&gt;</span>
  <span class="tag">&lt;head&gt;</span>
    <span class="tag">&lt;meta</span> <span class="atn">http-equiv</span><span class="pun">=</span><span class="atv">"Content-Type"</span> <span class="atn">content</span><span class="pun">=</span><span class="atv">"text/html; charset=UTF-8"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;script</span> <span class="atn">src</span><span class="pun">=</span><span class="atv">"todataurl.js"</span><span class="tag">&gt;&lt;/script&gt;</span>
    <span class="tag">&lt;script</span> <span class="atn">src</span><span class="pun">=</span><span class="atv">"signature.js"</span><span class="tag">&gt;&lt;/script&gt;</span>
  <span class="tag">&lt;/head&gt;</span>
  <span class="tag">&lt;body&gt;</span>
    <span class="tag">&lt;div</span> <span class="atn">id</span><span class="pun">=</span><span class="atv">"canvas"</span><span class="tag">&gt;</span>
      <span class="tag">&lt;canvas</span> <span class="atn">class</span><span class="pun">=</span><span class="atv">"roundCorners"</span> <span class="atn">id</span><span class="pun">=</span><span class="atv">"newSignature"</span>
      <span class="atn">style</span><span class="pun">=</span><span class="atv">"</span><span class="pln">position</span><span class="pun">:</span><span class="pln"> relative</span><span class="pun">;</span><span class="pln"> margin</span><span class="pun">:</span> <span class="lit">0</span><span class="pun">;</span><span class="pln"> padding</span><span class="pun">:</span> <span class="lit">0</span><span class="pun">;</span><span class="pln"> border</span><span class="pun">:</span> <span class="lit">1px</span><span class="pln"> solid </span><span class="com">#c4caac;</span><span class="atv">"</span><span class="tag">&gt;&lt;/canvas&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    <span class="tag">&lt;script&gt;</span><span class="pln">signatureCapture</span><span class="pun">();</span><span class="tag">&lt;/script&gt;</span>
    <span class="tag">&lt;button</span> <span class="atn">type</span><span class="pun">=</span><span class="atv">"button"</span> <span class="atn">onclick</span><span class="pun">=</span><span class="atv">"</span><span class="pln">signatureSave</span><span class="pun">()</span><span class="atv">"</span><span class="tag">&gt;</span><span class="pln">Save signature</span><span class="tag">&lt;/button&gt;</span>
    <span class="tag">&lt;button</span> <span class="atn">type</span><span class="pun">=</span><span class="atv">"button"</span> <span class="atn">onclick</span><span class="pun">=</span><span class="atv">"</span><span class="pln">signatureClear</span><span class="pun">()</span><span class="atv">"</span><span class="tag">&gt;</span><span class="pln">Clear signature</span><span class="tag">&lt;/button&gt;</span>
    <span class="tag">&lt;/br&gt;</span><span class="pln">
    Saved Image
    </span><span class="tag">&lt;/br&gt;</span>
    <span class="tag">&lt;img</span> <span class="atn">id</span><span class="pun">=</span><span class="atv">"saveSignature"</span> <span class="atn">alt</span><span class="pun">=</span><span class="atv">"Saved image png"</span><span class="tag">/&gt;</span>
  <span class="tag">&lt;/body&gt;</span>
<span class="tag">&lt;/html&gt;</span></pre>
</blockquote>";s:10:"post_title";s:17:"Capture Signature";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:17:"capture-signature";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2022-02-05 22:25:53";s:17:"post_modified_gmt";s:19:"2022-02-05 22:25:53";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:41:"https://kourentzes.com/konstantinos/?p=23";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}