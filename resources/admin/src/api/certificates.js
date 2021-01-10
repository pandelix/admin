import Request from '@/axios/request'

export function getCertificates(params) {
  return Request.get('certificates', { params })
}

export function createCertificate() {
  return Request.get('certificates/create')
}

export function storeCertificate(data) {
  return Request.post('certificates', data)
}

export function updateCertificate(id, data) {
  return Request.put(`certificates/${id}`, data)
}

export function editCertificate(id) {
  return Request.get(`certificates/${id}/edit`)
}

export function destroyCertificate(id) {
  return Request.delete(`certificates/${id}`)
}
