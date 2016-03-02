{% set start = (limit * (page.current - 1)) + 1 %}
{% set end = (limit * (page.current-1)) + limit %}
{% if end > page.total_items %}
  {% set end = page.total_items %}
{% endif %}

{% if limit %}
  <div>Showing {{ start }} - {{ end  }} of {{ page.total_items }}</div>
{% endif %}

<ul class="pagination">
  {% if page.current != 1 %}
    <li><a href="{{ paginationPath() }}1">&laquo;</a></li>
  {% endif %}

  {% for i in 1..page.total_pages %}
    <li><a {% if i == page.current %}class="active"{% endif %} href="{{ paginationPath() }}{{ i }}">{{ i }}</a></li>
  {% endfor %}

  {% if page.current != page.last %}
    <li><a href="{{ paginationPath() }}{{ page.last }}">&raquo;</a></li>
  {% endif %}
</ul>
