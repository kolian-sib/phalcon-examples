<h1>Robots</h1>

<table class="table table-striped">
  <thead>
    <th>
      <a href="?{{ sortLink('r.id') }}">ID</a> {{ sortIcon('r.id') }}
    </th>
    <th>
      <a href="?{{ sortLink('r.name') }}">Name</a> {{ sortIcon('r.name') }}
    </th>
    <th>
      <a href="?{{ sortLink('r.created') }}">Created</a> {{ sortIcon('r.created') }}
    </th>
  </thead>

  <tbody>
  {% for robot in pager.getPaginate().items %}
    <tr>
      <td>{{ robot.id }}</td>
      <td>{{ robot.name }}</td>
      <td>{{ robot.created }}</td>
    </tr>
  {% endfor %}
  </tbody>
</table>

{{ partial('partials/pagination', [
    'page': pager.getPaginate(),
    'limit': pager.getLimit()
  ])
}}
