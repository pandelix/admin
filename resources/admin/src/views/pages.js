export default {
  index: () => import('@v/Index'),

  'admin-permissions': () => import('@v/admin-permissions/Index'),
  'admin-permissions/create': () => import('@v/admin-permissions/Form'),
  'admin-permissions/:id(\\d+)/edit': () => import('@v/admin-permissions/Form'),

  'admin-roles': () => import('@v/admin-roles/Index'),
  'admin-roles/create': () => import('@v/admin-roles/Form'),
  'admin-roles/:id(\\d+)/edit': () => import('@v/admin-roles/Form'),

  'admin-users': () => import('@v/admin-users/Index'),
  'admin-users/create': () => import('@v/admin-users/Form'),
  'admin-users/:id(\\d+)/edit': () => import('@v/admin-users/Form'),

  'config-categories': () => import('@v/config-categories/Index'),

  configs: () => import('@v/configs/Index'),
  'configs/create': () => import('@v/configs/Form'),
  'configs/:id(\\d+)/edit': () => import('@v/configs/Form'),

  'vue-routers': () => import('@v/vue-routers/Index'),
  'vue-routers/create': () => import('@v/vue-routers/Form'),
  'vue-routers/:id(\\d+)/edit': () => import('@v/vue-routers/Form'),

  'system-media': () => import('@v/system-media/Index'),


  'rule': () => import('@v/rule/Index'),
  'rule/create': () => import('@v/rule/Form'),
  'rule/:id(\\d+)/edit': () => import('@v/rule/Form'),

  'certificates': () => import('@v/certificates/Index'),

}
