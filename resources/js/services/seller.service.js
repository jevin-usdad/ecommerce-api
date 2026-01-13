import api from './api';

export const createSeller = async (sellerForm) => {
  const payload = new FormData();

  payload.append('name', sellerForm.personal.name);
  payload.append('mobile_no', sellerForm.personal.mobile_no);
  payload.append('country', sellerForm.details.country);
  payload.append('state', sellerForm.details.state);

  payload.append('email', sellerForm.credentials.email);
  payload.append('password', sellerForm.credentials.password);
  payload.append(
    'password_confirmation',
    sellerForm.credentials.password_confirmation
  );

  if (sellerForm.personal.profile_image) {
    payload.append(
      'profile_image',
      sellerForm.personal.profile_image
    );
  }

  sellerForm.skills.forEach((skill, index) => {
    payload.append(`skills[${index}]`, skill);
  });

  return api.post('/admin/sellers', payload, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  });
};
